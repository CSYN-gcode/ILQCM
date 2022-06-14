<?php

namespace App\Http\Controllers;

// HELPERS
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Auth;

// MODEL
use App\Model\Monitoring;
use App\Model\DLACheckItem;
use App\Model\DLAResult;

// PACKAGE
use DataTables;
use Carbon;

class MonitoringController extends Controller
{
    //View Monitorings
    public function view_monitorings(Request $request){
        if($request->ajax()){
	        $data = Monitoring::select('monitorings.id as m_id', 'monitorings.product_line_id as m_product_line_id', 'monitorings.date_from as m_date_from', 'monitorings.date_to as m_date_to', 'line_id', 'work_week', 'shift', 'machine_id', 'qc_inspector', 'qc_checked_by', 'monitorings.status as m_status', 'lines.description as l_description', 'machines.description as m_description', 'uqi.name as uqi_name', 'qcb.name as qcb_name')
	        ->leftJoin('lines', 'monitorings.line_id', '=', 'lines.id')
	        ->leftJoin('machines', 'monitorings.machine_id', '=', 'machines.id')
	        ->leftJoin('users as uqi', 'uqi.id', '=', 'monitorings.qc_inspector')
	        ->leftJoin('users as qcb', 'qcb.id', '=', 'monitorings.qc_checked_by')
			->where('monitorings.logdel', 0)
			->where('monitorings.product_line_id', $request->product_line_id)
			->where('monitorings.status', $request->status)
			->where('monitorings.shift', $request->shift);

			if(isset($request->work_week)){
				$data->where('monitorings.work_week', $request->work_week);
			}
			
			$data->get();

			// return response()->json($data);

	        return DataTables::of($data)
	            ->addColumn('raw_status', function($row){
	                $result = "";

	                if($row->m_status == 1){
	                    $result .= '<span class="badge badge-pill bg-success">Active</span>';
	                }
	                else if($row->m_status == 2){
	                    $result .= '<span class="badge badge-pill bg-danger">Archived</span>';
	                }

	                return $result;
	            })
	            ->addColumn('raw_action', function($row){
	                $result = '';
	                if($row->m_status == 1){
	                    $result .= '<button type="button" class="btn btn-xs btn-primary table-btns btnEditMonitoring" monitoring-id="' . $row->m_id . '"><i class="fa fa-edit" title="Edit"></i></button>';

	                    $result .= ' <button type="button" class="btn btn-xs btn-danger table-btns btnActions" action="1" status="2" monitoring-id="' . $row->m_id . '" title="Archive"><i class="fa fa-lock"></i></button>';

	                    $result .= ' <a href="monitoring/' . $row->m_id . '" class="btn btn-xs btn-success table-btns btnViewMonitoring" monitoring-id="' . $row->m_id . '"><i class="fa fa-clipboard-list" title="View"></i></a>';
	                }
	                else{
	                    $result .= ' <button type="button" class="btn btn-xs btn-success table-btns btnActions" action="1" status="1" monitoring-id="' . $row->m_id . '" title="Restore"><i class="fa fa-unlock"></i></button>';
	                }

	                return $result;
	            })
	            ->rawColumns(['raw_status', 'raw_action'])
	            ->make(true);
        }
    	else{
    		abort(403);
    	}
    }

    public function save_monitoring(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        // Add Monitoring
		        if(!isset($request->monitoring_id)){
		            $data = $request->all();

		            $rules = [
		                'product_line_id' => 'required',
		                'line_id' => 'required',
		                'work_week' => 'required',
		                'date_from' => 'required',
		                'date_to' => 'required',
		                'shift' => 'required',
		                'machine_id' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                	$monitoring_info = Monitoring::where('line_id', $request->line_id)
								->where('work_week', $request->work_week)
								->where('shift', $request->shift)
			                	->first();

			                if($monitoring_info == null){
			                    Monitoring::insert([
			                        'product_line_id' => $request->product_line_id,
			                        'line_id' => $request->line_id,
			                        'work_week' => $request->work_week,
			                        'date_from' => $request->date_from,
			                        'date_to' => $request->date_to,
			                        'shift' => $request->shift,
			                        'machine_id' => $request->machine_id,
			                        'qc_inspector' => $request->qc_inspector,
			                        'qc_checked_by' => $request->qc_checked_by,
			                        'status' => 1,
			                        'created_by' => $_SESSION["rapidx_user_id"],
			                        'last_updated_by' => $_SESSION["rapidx_user_id"],
			                        'created_at' => date('Y-m-d H:i:s'),
			                        'updated_at' => date('Y-m-d H:i:s'),
			                    ]);
			                    return response()->json(['auth' => 1, 'result' => 1, 'error' => null]);
			                }
			                else{
			                	return response()->json(['auth' => 1, 'result' => 2, 'error' => null]);
			                }
		                }
		                else{
		                    return response()->json(['auth' => 1, 'result' => 0, 'error' => $validator->messages()]);    
		                }
		            }
		            catch(\Exception $e) {
		                return response()->json(['auth' => 1, 'result' => 0, 'error' => $e]);
		            }
		        }
		        // Edit Monitoring
		        else{
		            $data = $request->all();

		            $rules = [
		                'monitoring_id' => 'required|numeric',
		                'product_line_id' => 'required',
		                'line_id' => 'required',
		                'work_week' => 'required',
		                'shift' => 'required',
		                'machine_id' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                	$monitoring_info = Monitoring::where('id', '!=', $request->monitoring_id)
								->where('line_id', $request->line_id)
								->where('work_week', $request->work_week)
								->where('shift', $request->shift)
			                	->first();

							if($monitoring_info == null){
								Monitoring::where('id', $request->monitoring_id)
			                    	->where('logdel', 0)
			                    	->where('status', 1)
			                        ->update([
			                            'line_id' => $request->line_id,
				                        'shift' => $request->shift,
				                        'machine_id' => $request->machine_id,
				                        'qc_inspector' => $request->qc_inspector,
				                        'qc_checked_by' => $request->qc_checked_by,
			                            'last_updated_by' => $_SESSION["rapidx_user_id"],
			                            'updated_at' => date('Y-m-d H:i:s'),
			                        ]);

		                    	return response()->json(['auth' => 1, 'result' => 1, 'error' => null]);
							}
			                else{
			                	return response()->json(['auth' => 1, 'result' => 2, 'error' => null]);
			                }
		                }
		                else{
		                    return response()->json(['auth' => 1, 'result' => 0, 'error' => $validator->messages()]);    
		                }
		            }
		            catch(\Exception $e) {
		                return response()->json(['auth' => 1, 'result' => 0, 'error' => $e]);
		            }
		        }
	        }
	        else{
	        	return response()->json(['auth' => 0, 'result' => 0, 'error' => null]);
	        }
	    }
    	else{
    		abort(403);
    	}
    }

    public function get_monitoring_by_id(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        $data = [
		            'monitoring_id' => $request->monitoring_id,
		        ];

		        $rules = [
		            'monitoring_id' => 'required',
		        ];

		        $validator = Validator::make($data, $rules);

		        if($validator->passes()){
		            $monitoring_info = Monitoring::select('monitorings.id as m_id', 'monitorings.product_line_id as m_product_line_id', 'monitorings.date_from as m_date_from', 'monitorings.date_to as m_date_to', 'line_id', 'work_week', 'shift', 'machine_id', 'qc_inspector', 'qc_checked_by', 'monitorings.status as m_status', 'lines.description as l_description', 'machines.description as m_description', 'uqi.name as uqi_name', 'uqi.employee_id as uqi_employee_id', 'qcb.name as qcb_name', 'qcb.employee_id as qcb_employee_id')
			        ->leftJoin('lines', 'monitorings.line_id', '=', 'lines.id')
			        ->leftJoin('machines', 'monitorings.machine_id', '=', 'machines.id')
			        ->leftJoin('users as uqi', 'uqi.id', '=', 'monitorings.qc_inspector')
			        ->leftJoin('users as qcb', 'qcb.id', '=', 'monitorings.qc_checked_by')
		            ->where('monitorings.id', $request->monitoring_id)
		            ->where('monitorings.status', 1)
		            ->where('monitorings.logdel', 0)
		            ->first();

		            return response()->json(['auth' => 1, 'monitoring_info' => $monitoring_info, 'result' => 1]);
		        }
		        else{
		            return response()->json(['auth' => 1, 'monitoring_info' => null, 'result' => 0]);  
		        }
		    }
		    else{
	        	return response()->json(['auth' => 0, 'result' => 0, 'error' => null]);
		    }
		}
    	else{
    		abort(403);
    	}
    }

    public function monitoring_action(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        // Change Monitoring Status
	        if(isset($_SESSION["rapidx_user_id"])){
		        if($request->action == 1){
		            $data = [
		                'monitoring_id' => $request->monitoring_id,
		                'status' => $request->status,
		            ];

		            $rules = [
		                'monitoring_id' => 'required',
		                'status' => 'required|numeric',
		            ];

		            $validator = Validator::make($data, $rules);

		            if($validator->passes()){
		                try {
		                    Monitoring::where('id', $request->monitoring_id)
		                    	->where('logdel', 0)
		                        ->update([
		                            'status' => $request->status,
		                            'last_updated_by' => $_SESSION["rapidx_user_id"],
		                            'updated_at' => date('Y-m-d H:i:s'),
		                        ]);

		                    return response()->json(['auth' => 1, 'result' => 1, 'error']);
		                } 
		                catch (Exception $e) {
		                    return response()->json(['auth' => 1, 'monitoring_info' => null]); 
		                }
		            }
		            else{
		                return response()->json(['auth' => 1, 'result' => 0, 'error' => $validator->messages()]);    
		            }
		        }
	        } // Session Expired
		    else{
	        	return response()->json(['auth' => 0, 'result' => 0, 'error' => null]);
		    }  
		}
    	else{
    		abort(403);
    	}
    }

    public function get_cbo_monitoring_by_stat(Request $request){
        date_default_timezone_set('Asia/Manila');

        if($request->ajax()){
        	if(isset($_SESSION["rapidx_user_id"])){
		        $search = $request->search;

		        if($search == ''){
		            $monitorings = [];
		        }
		        else{
		            $monitorings = Monitoring::orderby('description','asc')->select('id','description')
		                        ->where('description', 'like', '%' . $search . '%')
		                        ->where('status', 1)
		                        ->where('logdel', 0)
		                        ->get();
		        }

		        $response = array();
		        $response[] = array(
	                "id" => '',
	                "text" => '',
	            );

		        foreach($monitorings as $monitoring){
		            $response[] = array(
		                "id" => $monitoring->id,
		                "text" => $monitoring->description,
		            );
		        }

		        echo json_encode($response);
		        exit;
        	}
        	else{
        		$response = array();
		            $response[] = array(
		                "id" => '',
		                "text" => 'Please reload again.',
		            );

		        echo json_encode($response);
        	}
        }
    	else{
    		abort(403);
    	}
    }

    public function save_dla(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        // Change Monitoring Status
	        if(isset($_SESSION["rapidx_user_id"])){
	            $data = [
	                'monitoring_id' => $request->monitoring_id,
	                'dla_check_items' => $request->dla_check_items,
	            ];

	            $rules = [
	                'monitoring_id' => 'required',
	                'dla_check_items' => 'required',
	            ];

	            $validator = Validator::make($data, $rules);

	            if($validator->passes()){
	            	DB::beginTransaction();
	                try {
	                	DLACheckItem::where('monitoring_id', $request->monitoring_id)
	                        ->update([
		                        'status' => 0,
	                            'last_updated_by' => $_SESSION["rapidx_user_id"],
	                            'updated_at' => date('Y-m-d H:i:s'),
	                        ]);

	                	foreach ($request->dla_check_items as $dla_check_item) {
	                		$dla_check_item_info = DLACheckItem::where('monitoring_id', $request->monitoring_id)
	                			->where('index', $dla_check_item['index'])
	                			->first();
	                		if($dla_check_item_info == null){
		                    	DLACheckItem::insert([
			                        'monitoring_id' => $request->monitoring_id,
									'value' => $dla_check_item['value'],
									'index' => $dla_check_item['index'],
									'date_index' => $dla_check_item['date_index'],
									'date' => $dla_check_item['date'],
			                        'status' => 1,
			                        'created_by' => $_SESSION["rapidx_user_id"],
			                        'last_updated_by' => $_SESSION["rapidx_user_id"],
			                        'created_at' => date('Y-m-d H:i:s'),
			                        'updated_at' => date('Y-m-d H:i:s'),
			                    ]);
	                		}
	                		else{
	                			DLACheckItem::where('monitoring_id', $request->monitoring_id)
			                    	->where('index', $dla_check_item['index'])
			                        ->update([
			                            'value' => $dla_check_item['value'],
				                        'status' => 1,
			                            'last_updated_by' => $_SESSION["rapidx_user_id"],
			                            'updated_at' => date('Y-m-d H:i:s'),
			                        ]);
	                		}
	                	}

	                	DLAResult::where('monitoring_id', $request->monitoring_id)
	                        ->update([
		                        'status' => 0,
	                            'last_updated_by' => $_SESSION["rapidx_user_id"],
	                            'updated_at' => date('Y-m-d H:i:s'),
	                        ]);

	                    if(isset($request->dla_results)){
	                    	if(count($request->dla_results) > 0){
	                    		foreach ($request->dla_results as $dla_result) {
			                		$dla_result_info = DLAResult::where('monitoring_id', $request->monitoring_id)
			                			->where('index', $dla_result['index'])
			                			->first();

									if(isset($dla_result['result'])){
										$result = $dla_result['result'];
									}
									else{
										$result = null;
									}
									if(isset($dla_result['person_in_charge'])){
										$person_in_charge = $dla_result['person_in_charge'];
									}
									else{
										$person_in_charge = null;
									}
									if(isset($dla_result['due_date'])){
										$due_date = $dla_result['due_date'];
									}
									else{
										$due_date = null;
									}
									if(isset($dla_result['corrective_action'])){
										$corrective_action = $dla_result['corrective_action'];
									}
									else{
										$corrective_action = null;
									}

			                		if($dla_result_info == null){
				                    	DLAResult::insert([
					                        'monitoring_id' => $request->monitoring_id,
											'result' => $result,
											'person_in_charge' => $person_in_charge,
											'capa_due_date' => $due_date,
											'corrective_action' => $corrective_action,
											'index' => $dla_result['index'],
											'date_index' => $dla_result['date_index'],
											'date' => $dla_result['date'],
					                        'status' => 1,
					                        'created_by' => $_SESSION["rapidx_user_id"],
					                        'last_updated_by' => $_SESSION["rapidx_user_id"],
					                        'created_at' => date('Y-m-d H:i:s'),
					                        'updated_at' => date('Y-m-d H:i:s'),
					                    ]);
			                		}
			                		else{
			                			DLAResult::where('monitoring_id', $request->monitoring_id)
					                    	->where('index', $dla_result['index'])
					                        ->update([
					                            'result' => $result,
												'person_in_charge' => $person_in_charge,
												'capa_due_date' => $due_date,
												'corrective_action' => $corrective_action,
						                        'status' => 1,
					                            'last_updated_by' => $_SESSION["rapidx_user_id"],
					                            'updated_at' => date('Y-m-d H:i:s'),
					                        ]);
			                		}
			                	}
	                    	}
	                    }

	                	DB::commit();
	                    return response()->json(['auth' => 1, 'result' => 1, 'error']);
	                } 
	                catch (Exception $e) {
	                	DB::rollback();
	                    return response()->json(['auth' => 1, 'monitoring_info' => null]); 
	                }
	            }
	            else{
	                return response()->json(['auth' => 1, 'result' => 0, 'error' => $validator->messages()]);    
	            }
	        } // Session Expired
		    else{
	        	return response()->json(['auth' => 0, 'result' => 0, 'error' => null]);
		    }  
		}
    	else{
    		abort(403);
    	}
    }

    public function get_dla_by_monitoring_id(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        $data = [
		            'monitoring_id' => $request->monitoring_id,
		        ];

		        $rules = [
		            'monitoring_id' => 'required',
		        ];

		        $validator = Validator::make($data, $rules);

		        if($validator->passes()){
		            $dla_check_items = DLACheckItem::where('monitoring_id', $request->monitoring_id)
		            	->where('status', 1)
		            	->where('logdel', 0)
		            	->get();

		            $dla_results = DLAResult::select('dla_results.*', 'users.name as user_name', 'users.employee_id')
		            	->leftJoin('users', 'users.id', '=', 'dla_results.person_in_charge')
		            	->where('dla_results.monitoring_id', $request->monitoring_id)
		            	->where('dla_results.status', 1)
		            	->where('dla_results.logdel', 0)
		            	->get();

		            return response()->json(['auth' => 1, 'dla_check_items' => $dla_check_items, 'dla_results' => $dla_results, 'result' => 1]);
		        }
		        else{
		            return response()->json(['auth' => 1, 'dla_check_items' => null, 'result' => 0]);  
		        }
		    }
		    else{
	        	return response()->json(['auth' => 0, 'result' => 0, 'error' => null]);
		    }
		}
    	else{
    		abort(403);
    	}
    }
}
