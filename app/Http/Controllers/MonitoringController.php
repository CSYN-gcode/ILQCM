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
        // date_default_timezone_set('Asia/Manila');
        // $FiscalYearNow = Carbon::now()->format('m');
        if($request->ajax()){
	        $data = Monitoring::select('monitorings.id as m_id', 'monitorings.product_line_id as m_product_line_id', 'monitorings.date_from as m_date_from', 'monitorings.date_to as m_date_to', 'line_id', 'work_week', 'shift', 'machine_id', 'qc_inspector', 'qc_checked_by', 'monitorings.status as m_status', 'lines.description as l_description', 'machines.description as m_description', 'uqi.name as uqi_name', 'qcb.name as qcb_name')
	        ->leftJoin('lines', 'monitorings.line_id', '=', 'lines.id')
	        ->leftJoin('machines', 'monitorings.machine_id', '=', 'machines.id')
	        ->leftJoin('users as uqi', 'uqi.id', '=', 'monitorings.qc_inspector')
	        ->leftJoin('users as qcb', 'qcb.id', '=', 'monitorings.qc_checked_by')
			->where('monitorings.logdel', 0)
			->where('monitorings.product_line_id', $request->product_line_id)
			->where('monitorings.status', $request->status)
			->where('monitorings.shift', $request->shift)
            ->when($request->work_week, function ($query) use ($request) {
                return $query ->where('monitorings.work_week', $request->work_week);
            })
            ->when($request->year, function ($query) use ($request) {
                // return $query ->where('date_from', 'like', '%'.$request->year.'-%')->where('date_to', 'like', '%'.$request->year.'-%');
                $fiscalStart = $request->year . '-04-01';
                $fiscalEnd = ($request->year + 1) . '-03-31';

                $query->where(function ($q) use ($fiscalStart, $fiscalEnd, $request) {
                    $q->whereBetween('date_from', [$fiscalStart, $fiscalEnd])
                      ->orWhereBetween('date_to', [$fiscalStart, $fiscalEnd])
                      ->orWhere(function ($q) use ($fiscalStart, $fiscalEnd) {
                          $q->where('date_from', '<', $fiscalStart)
                            ->where('date_to', '>', $fiscalEnd);
                      });

                    // If searching for a previous fiscal year, include Jan–March of next year
                    if ($request->year < date('Y')) {
                        $q->orWhere(function ($q) use ($request) {
                            $q->whereYear('date_from', $request->year + 1)
                              ->whereMonth('date_from', '<=', 3);
                        });
                    }
                });

                // If searching for 2026, exclude Jan–March 2026
                // if ($request->year == date('Y') + 1) {
                //     $query->where(function ($q) {
                //         $q->whereYear('date_from', '>', date('Y') + 1); // Exclude any data from January-March 2026
                //     });
                // }
                // $query->where(function ($q) use ($fiscalStart, $fiscalEnd, $request) {
                //     $q->whereBetween('date_from', [$fiscalStart, $fiscalEnd])
                //     ->orWhereBetween('date_to', [$fiscalStart, $fiscalEnd])
                //     ->orWhere(function ($q) use ($fiscalStart, $fiscalEnd) {
                //         $q->where('date_from', '<', $fiscalStart)
                //             ->where('date_to', '>', $fiscalEnd);
                //     });
                // });

                // // Include records in Jan–March of next year that belong to the fiscal year
                // if ($request->year < date('Y')) {
                //     $query->orWhere(function ($q) use ($request) {
                //         $q->whereYear('date_from', $request->year + 1)
                //             ->whereMonth('date_from', '<=', 3);
                //     });
                // }

                // return $query;
                // return $query ->whereBetween('date_from', [$request->year.'-03-30' , ($request->year + 1).'-03-31'])->whereBetween('date_to', [$request->year.'-03-30' , ($request->year + 1).'-03-31']);
            });

			// if(isset($request->work_week)){
			// 	$data->where('monitorings.work_week', $request->work_week);
			// }

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
								->where('date_from', $request->date_from)
								->where('date_to', $request->date_to)
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

/* nmodify MIGZ 10232023 NOTE: error found, This is edit details there is not need to validation if the data is exist

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
*/
                            Monitoring::where('id', $request->monitoring_id)
			                    	->where('logdel', 0)
			                    	->where('status', 1)
			                        ->update([
			                            'line_id' => $request->line_id,
				                        'shift' => $request->shift,

                                        //clark 01/02/2024 comment: to be implemented to enable edit of work week
				                        // 'work_week' => $request->work_week,
                                        // 'date_from' => $request->date_from,
                                        // 'date_to' => $request->date_to,
                                        //clark 01/02/2024 comment: to be implemented to enable edit of work week

				                        'machine_id' => $request->machine_id,
				                        'qc_inspector' => $request->qc_inspector,
				                        'qc_checked_by' => $request->qc_checked_by,
			                            'last_updated_by' => $_SESSION["rapidx_user_id"],
			                            'updated_at' => date('Y-m-d H:i:s'),
			                        ]);
		                    return response()->json(['auth' => 1, 'result' => 1, 'error' => null]);
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

    public function save_unchecked_dla_check_items(Request $request){ //nmodify
        date_default_timezone_set('Asia/Manila');
        session_start();

        if(isset($request->unchecked_dlaCheckItems)){
            if(isset($_SESSION["rapidx_user_id"])){
                $data = [
	                'monitoring_id' => $request->monitoring_id,
	                // 'unchecked_dla_check_items' => $request->unchecked_dla_check_items,
	            ];

	            $rules = [
	                'monitoring_id' => 'required',
	                // 'unchecked_dla_check_items' => 'required',
                    // 'person_in_charge' => 'required',
	            ];

                $validator = Validator::make($data, $rules);
	            if($validator->passes()){
	            	DB::beginTransaction();
	                try{
	                	foreach ($request->unchecked_dlaCheckItems as $unchecked_dlaCheckItem) {
                            DLACheckItem::where('monitoring_id', $request->monitoring_id)
                                    ->where('index', $unchecked_dlaCheckItem['index'])
                                    ->update([
                                        'status' => 0, //UNSET the checkboxes
                                        'last_updated_by' => $_SESSION["rapidx_user_id"],
                                        'updated_at' => date('Y-m-d H:i:s'),
                                    ]);
                        }
                        DB::commit();
	                    return response()->json(['auth' => 1, 'result' => 1, 'success']);
                    }catch (\Exception $err) {
	                	DB::rollback();
						return response()->json(['auth' => 1, 'error_msg' => $err->getMessage()]);
					}
                }else{
	                return response()->json(['auth' => 1, 'result' => 0, 'error' => $validator->messages()]);
	            }
            }
            else{
                return response()->json(['auth' => 0, 'result' => 0, 'error' => null]);
            }
        }else{
    		return response()->json(['auth' => 1, 'result' => 1, 'error' => null]);
    	}
    }

    public function save_first_arr_dla_check_items(Request $request){ //nmodify
        date_default_timezone_set('Asia/Manila');
        session_start();

        // return $request->all();

        if($request->ajax()){
	        // Change Monitoring Status
	        if(isset($_SESSION["rapidx_user_id"])){
	            $data = [
	                'monitoring_id' => $request->monitoring_id,
	                'first_dla_check_items' => $request->first_dla_check_items,
	            ];

	            $rules = [
	                'monitoring_id' => 'required',
	                // 'first_dla_check_items' => 'required',
                    // 'person_in_charge' => 'required',
	            ];

	            $validator = Validator::make($data, $rules);

	            if($validator->passes()){
	            	DB::beginTransaction();
	                try {
                        // commented by clark
	                	// DLACheckItem::where('monitoring_id', $request->monitoring_id)
                        //     ->where('index', $request->$unchecked_dlaCheckItems['index'])
	                    //     ->update([
		                //         'status' => 0,
	                    //         'last_updated_by' => $_SESSION["rapidx_user_id"],
	                    //         'updated_at' => date('Y-m-d H:i:s'),
	                    //     ]);
                        if($request->first_dla_check_items == null){
                            return response()->json(['auth' => 1, 'result' => 1, 'first_dla_check_items' => null]);
                            // return "test";
                        }else if($request->first_dla_check_items != null){
	                	    foreach ($request->first_dla_check_items as $first_dla_check_items) {

                                $dla_check_item_info = DLACheckItem::where('monitoring_id', $request->monitoring_id)
                                    ->where('index', $first_dla_check_items['index'])
                                    ->first();

                                    // var_dump($dla_check_item);

                                if($dla_check_item_info == null){
                                    DLACheckItem::insert([
                                        'monitoring_id' => $request->monitoring_id,
                                        'value' => $first_dla_check_items['value'],
                                        'index' => $first_dla_check_items['index'],
                                        'date_index' => $first_dla_check_items['date_index'],
                                        'date' => $first_dla_check_items['date'],
                                        'status' => 1,
                                        'created_by' => $_SESSION["rapidx_user_id"],
                                        'last_updated_by' => $_SESSION["rapidx_user_id"],
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s'),
                                    ]);
                                }
                                else{
                                    // var_dump($dla_check_item['index']);
                                    DLACheckItem::where('monitoring_id', $request->monitoring_id)
                                        ->where('index', $first_dla_check_items['index'])
                                        ->update([
                                            'value' => $first_dla_check_items['value'],
                                            'status' => 1,
                                            'last_updated_by' => $_SESSION["rapidx_user_id"],
                                            'updated_at' => date('Y-m-d H:i:s'),
                                        ]);
                                }
                            }
                        }

	                	DB::commit();
	                    return response()->json(['auth' => 1, 'result' => 1, 'success']);
	                }
	                catch (\Exception $err) {
	                	DB::rollback();
						return response()->json(['auth' => 1, 'error_msg' => $err->getMessage()]);
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
    		// abort(403);
			return 'logout';
    	}
    }

    public function save_second_arr_dla_check_items(Request $request){ //nmodify
        date_default_timezone_set('Asia/Manila');
        session_start();

        // return $request->all();

        if($request->ajax()){
	        // Change Monitoring Status
	        if(isset($_SESSION["rapidx_user_id"])){
	            $data = [
	                'monitoring_id' => $request->monitoring_id,
	                'second_dla_check_items' => $request->second_dla_check_items,
	            ];

	            $rules = [
	                'monitoring_id' => 'required',
	                // 'second_dla_check_items' => 'required',
                    // 'person_in_charge' => 'required',
	            ];

	            $validator = Validator::make($data, $rules);

	            if($validator->passes()){
	            	DB::beginTransaction();
	                try {
                        // commented by clark
	                	// DLACheckItem::where('monitoring_id', $request->monitoring_id)
	                    //     ->update([
		                //         'status' => 0,
	                    //         'last_updated_by' => $_SESSION["rapidx_user_id"],
	                    //         'updated_at' => date('Y-m-d H:i:s'),
	                    //     ]);

                        if($request->second_dla_check_items == null){
                            return response()->json(['auth' => 1, 'result' => 1, 'second_dla_check_items' => null]);
                            // return "test";
                        }else if($request->second_dla_check_items != null){
                            foreach ($request->second_dla_check_items as $second_dla_check_items) {

                                $dla_check_item_info = DLACheckItem::where('monitoring_id', $request->monitoring_id)
                                                    ->where('index', $second_dla_check_items['index'])
                                                    ->first();

                                    // var_dump($dla_check_item);

                                if($dla_check_item_info == null){
                                    DLACheckItem::insert([
                                        'monitoring_id' => $request->monitoring_id,
                                        'value' => $second_dla_check_items['value'],
                                        'index' => $second_dla_check_items['index'],
                                        'date_index' => $second_dla_check_items['date_index'],
                                        'date' => $second_dla_check_items['date'],
                                        'status' => 1,
                                        'created_by' => $_SESSION["rapidx_user_id"],
                                        'last_updated_by' => $_SESSION["rapidx_user_id"],
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'updated_at' => date('Y-m-d H:i:s'),
                                    ]);
                                }
                                else{
                                    // var_dump($dla_check_item['index']);
                                    DLACheckItem::where('monitoring_id', $request->monitoring_id)
                                        ->where('index', $second_dla_check_items['index'])
                                        ->update([
                                            'value' => $second_dla_check_items['value'],
                                            'status' => 1,
                                            'last_updated_by' => $_SESSION["rapidx_user_id"],
                                            'updated_at' => date('Y-m-d H:i:s'),
                                        ]);
                                }
                            }

                            DB::commit();
                            return response()->json(['auth' => 1, 'result' => 1, 'success']);
                        }
                    }
	                catch (\Exception $err) {
	                	DB::rollback();
						return response()->json(['auth' => 1, 'error_msg' => $err->getMessage()]);
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
    		// abort(403);
			return 'logout';
    	}
    }

    public function save_dla_results(Request $request){ //nmodify
        date_default_timezone_set('Asia/Manila');
        session_start();

        // return $request->all();

        if($request->ajax()){
	        // Change Monitoring Status
	        if(isset($_SESSION["rapidx_user_id"])){
	            $data = [
	                'monitoring_id' => $request->monitoring_id,
	                // 'dla_check_items' => $request->dla_check_items,
	            ];

	            $rules = [
	                'monitoring_id' => 'required',
	                // 'dla_check_items' => 'required',
                    // 'person_in_charge' => 'required',
	            ];

	            $validator = Validator::make($data, $rules);

	            if($validator->passes()){
	            	DB::beginTransaction();
	                try {

						$ctr = 0;
	                    if(isset($request->dla_results)){
	                    	if(count($request->dla_results) > 0){

                                //commented by clark
                                // DLAResult::where('monitoring_id', $request->monitoring_id)
                                //         ->update([
                                //             'status' => 0,
                                //             'last_updated_by' => $_SESSION["rapidx_user_id"],
                                //             'updated_at' => date('Y-m-d H:i:s'),
                                //         ]);

	                    		foreach ($request->dla_results as $dla_result){

                                    if(isset($dla_result['index'])){
                                        $index_results = $dla_result['index'];
                                    }else{
                                        $index_results = null;
                                    }

                                    // var_dump($dla_result['index']);

                                    /*MODIFY BY MIGZ 2023  - The developer did not required the INDEX, DATE, DATE INDEX
                                        Solution: If the user wants to required the ff. add those fields to the rules.
                                     */
                                    $dla_result_info = DLAResult::where('monitoring_id', $request->monitoring_id)
                                        ->where('index', $index_results)
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
                                    if(isset($dla_result['date'])){
										$date_result = $dla_result['date'];
									}
									else{
										$date_result = null;
									}
									if(isset($dla_result['date_index'])){
										$date_index_results = $dla_result['date_index'];
									}
									else{
										$date_index_results = null;
									}

			                		if($dla_result_info == null){
				                    	DLAResult::insert([
					                        'monitoring_id' => $request->monitoring_id,
											'result' => $result,
											'person_in_charge' => $person_in_charge,
											'capa_due_date' => $due_date,
											'corrective_action' => $corrective_action,
											'index' => $index_results,
											'date_index' => $date_index_results,
											'date' => $date_result,
					                        'status' => 1,
					                        'created_by' => $_SESSION["rapidx_user_id"],
					                        'last_updated_by' => $_SESSION["rapidx_user_id"],
					                        'created_at' => date('Y-m-d H:i:s'),
					                        'updated_at' => date('Y-m-d H:i:s'),
					                    ]);
			                		}
			                		else{
			                			DLAResult::where('monitoring_id', $request->monitoring_id)
					                    	->where('index', $index_results)
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
	                    return response()->json(['auth' => 1, 'result' => 1, 'success']);
	                }
	                catch (\Exception $err) {
	                	DB::rollback();
						// return $err;
						return response()->json(['auth' => 1, 'error_msg' => $err->getMessage()]);
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
    		// abort(403);
			return 'logout';
    	}
    }

    // public function save_dla(Request $request){ //nmodify
    //     date_default_timezone_set('Asia/Manila');
    //     session_start();
	// 	// return 'true 2';
    //     if($request->ajax()){
	//         // Change Monitoring Status
	//         if(isset($_SESSION["rapidx_user_id"])){
	//             $data = [
	//                 'monitoring_id' => $request->monitoring_id,
	//                 'dla_check_items' => $request->dla_check_items,
	//                 // 'dla_results' => $request->dla_results,
	//             ];

	//             $rules = [
	//                 'monitoring_id' => 'required',
	//                 'dla_check_items' => 'required',
	//                 // 'dla_results' => 'required',
	//             ];

	//             $validator = Validator::make($data, $rules);

	//             if($validator->passes()){
	//             	DB::beginTransaction();
	//                 try {
	//                 	DLACheckItem::where('monitoring_id', $request->monitoring_id)
	//                         ->update([
	// 	                        'status' => 0,
	//                             'last_updated_by' => $_SESSION["rapidx_user_id"],
	//                             'updated_at' => date('Y-m-d H:i:s'),
	//                         ]);

	//                 	foreach ($request->dla_check_items as $dla_check_item) {
	// 						// var_dump($dla_check_item['index']);

	//                 		$dla_check_item_info = DLACheckItem::where('monitoring_id', $request->monitoring_id)
	//                 			->where('index', $dla_check_item['index'])
	//                 			->first();
	//                 		if($dla_check_item_info == null){
	// 	                    	DLACheckItem::insert([
	// 		                        'monitoring_id' => $request->monitoring_id,
	// 								'value' => $dla_check_item['value'],
	// 								'index' => $dla_check_item['index'],
	// 								'date_index' => $dla_check_item['date_index'],
	// 								'date' => $dla_check_item['date'],
	// 		                        'status' => 1,
	// 		                        'created_by' => $_SESSION["rapidx_user_id"],
	// 		                        'last_updated_by' => $_SESSION["rapidx_user_id"],
	// 		                        'created_at' => date('Y-m-d H:i:s'),
	// 		                        'updated_at' => date('Y-m-d H:i:s'),
	// 		                    ]);
	//                 		}
	//                 		else{
	//                 			DLACheckItem::where('monitoring_id', $request->monitoring_id)
	// 		                    	->where('index', $dla_check_item['index'])
	// 		                        ->update([
	// 		                            'value' => $dla_check_item['value'],
	// 			                        'status' => 1,
	// 		                            'last_updated_by' => $_SESSION["rapidx_user_id"],
	// 		                            'updated_at' => date('Y-m-d H:i:s'),
	// 		                        ]);
	//                 		}

	//                 	}

	//                 	DLAResult::where('monitoring_id', $request->monitoring_id)
	//                         ->update([
	// 	                        'status' => 0,
	//                             'last_updated_by' => $_SESSION["rapidx_user_id"],
	//                             'updated_at' => date('Y-m-d H:i:s'),
	//                         ]);

	// 					$ctr = 0;
	//                     if(isset($request->dla_results)){
	//                     	if(count($request->dla_results) > 0){
	//                     		foreach ($request->dla_results as $dla_result) {
	// 								// var_dump($dla_result['index']);
    //                                 echo json_encode($dla_result);
    //                                 // return;
    //                                 /*
    //                                 string(3) "1.1"
    //                                 string(3) "1.2"
    //                                 string(3) "1.3"
    //                                 string(3) "1.4"
    //                                 string(3) "1.5"
    //                                 string(3) "1.6"
    //                                 string(3) "1.7"
    //                                 {"auth":1,"result":1,"0":"success"}
    //                                  */
    //                                 // return;
	// 		                		$dla_result_info = DLAResult::where('monitoring_id', $request->monitoring_id)
	// 		                			->where('index', $dla_result['index'])
	// 		                			->first();

	// 								if(isset($dla_result['result'])){
	// 									$result = $dla_result['result'];
	// 								}
	// 								else{
	// 									$result = null;
	// 								}
	// 								if(isset($dla_result['person_in_charge'])){
	// 									$person_in_charge = $dla_result['person_in_charge'];
	// 								}
	// 								else{
	// 									$person_in_charge = null;
	// 								}
	// 								if(isset($dla_result['due_date'])){
	// 									$due_date = $dla_result['due_date'];
	// 								}
	// 								else{
	// 									$due_date = null;
	// 								}
	// 								if(isset($dla_result['corrective_action'])){
	// 									$corrective_action = $dla_result['corrective_action'];
	// 								}
	// 								else{
	// 									$corrective_action = null;
	// 								}
	// 		                		if($dla_result_info == null){
	// 			                    	DLAResult::insert([
	// 				                        'monitoring_id' => $request->monitoring_id,
	// 										'result' => $result,
	// 										'person_in_charge' => $person_in_charge,
	// 										'capa_due_date' => $due_date,
	// 										'corrective_action' => $corrective_action,
	// 										'index' => $dla_result['index'],
	// 										'date_index' => $dla_result['date_index'],
	// 										'date' => $dla_result['date'],
	// 				                        'status' => 1,
	// 				                        'created_by' => $_SESSION["rapidx_user_id"],
	// 				                        'last_updated_by' => $_SESSION["rapidx_user_id"],
	// 				                        'created_at' => date('Y-m-d H:i:s'),
	// 				                        'updated_at' => date('Y-m-d H:i:s'),
	// 				                    ]);
	// 		                		}
	// 		                		else{
	// 		                			DLAResult::where('monitoring_id', $request->monitoring_id)
	// 				                    	->where('index', $dla_result['index'])
	// 				                        ->update([
	// 				                            'result' => $result,
	// 											'person_in_charge' => $person_in_charge,
	// 											'capa_due_date' => $due_date,
	// 											'corrective_action' => $corrective_action,
	// 					                        'status' => 1,
	// 				                            'last_updated_by' => $_SESSION["rapidx_user_id"],
	// 				                            'updated_at' => date('Y-m-d H:i:s'),
	// 				                        ]);
	// 		                		}
	// 								// return 'success';
	// 		                	}
	//                     	}
	//                     }

	//                 	DB::commit();
	//                     return response()->json(['auth' => 1, 'result' => 1, 'success']);
	//                 }
	//                 catch (\Exception $err) {
	//                 	DB::rollback();
	// 					return $err;
	// 					// return response()->json(['auth' => 1, 'error_msg' => $err->getMessage()]);
	// 				}
	//             }
	//             else{
	//                 return response()->json(['auth' => 1, 'result' => 0, 'error' => $validator->messages()]);
	//             }
	//         } // Session Expired
	// 	    else{
	//         	return response()->json(['auth' => 0, 'result' => 0, 'error' => null]);
	// 	    }
	// 	}
    // 	else{
    // 		// abort(403);
	// 		return 'logout';
    // 	}
    // }

    public function get_dla_check_items_by_monitoring_id(Request $request){
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

		            return response()->json(['auth' => 1, 'dla_check_items' => $dla_check_items, 'result' => 1]);
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

    public function get_dla_results_by_monitoring_id(Request $request){
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

		            $dla_results = DLAResult::select('dla_results.*', 'users.name as user_name', 'users.employee_id')
		            	->leftJoin('users', 'users.id', '=', 'dla_results.person_in_charge')
		            	->where('dla_results.monitoring_id', $request->monitoring_id)
		            	// ->Where('dla_results.status', '!=', 2)
		            	->where('dla_results.status', 1)
		            	->where('dla_results.logdel', 0)
		            	->get();

		            return response()->json(['auth' => 1, 'dla_results' => $dla_results, 'result' => 1]);
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
