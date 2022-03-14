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
use App\User;
use App\Model\Sampling;
use App\Model\MaterialIssuanceSubSystem;

// PACKAGE
use DataTables;
use Carbon\Carbon;

class SamplingController extends Controller
{
    //View Samplings
    public function view_samplings(Request $request){
        if($request->ajax()){
	        $data = Sampling::select('samplings.*', 'users.name as operator_name', 'stations.description as s_description')
	        			->leftJoin('users', 'samplings.operator', '=', 'users.id')
	        			->leftJoin('stations', 'samplings.station_id', '=', 'stations.id')
	        			->where('samplings.monitoring_id', $request->monitoring_id)
	        			->where('samplings.logdel', 0)
	        			->where('samplings.status', $request->status)
        				->get();

	        return DataTables::of($data)
	            ->addColumn('raw_status', function($row){
	                $result = "";

	                if($row->status == 1){
	                    $result .= '<span class="badge badge-pill bg-success">Active</span>';
	                }
	                else if($row->status == 2){
	                    $result .= '<span class="badge badge-pill bg-danger">Archived</span>';
	                }

	                return $result;
	            })
	            ->addColumn('raw_date', function($row){
	                return Carbon::parse($row->created_at)->format('m/d/Y');;
	            })
	            ->addColumn('raw_time', function($row){
	                return Carbon::parse($row->created_at)->format('H:i');;
	            })
	            ->addColumn('raw_po_no_series', function($row){
	                return $row->po_no . " / " . $row->series;
	            })
	            ->addColumn('raw_action', function($row){
	                $result = '';
	                if($row->status == 1){
	                    $result .= '<button type="button" class="btn btn-xs btn-primary table-btns btnEditSampling" sampling-id="' . $row->id . '"><i class="fa fa-edit" title="Edit"></i></button>';

	                    $result .= ' <button type="button" class="btn btn-xs btn-danger table-btns btnActions" action="1" status="2" sampling-id="' . $row->id . '" title="Archive"><i class="fa fa-lock"></i></button>';
	                }
	                else{
	                    $result .= ' <button type="button" class="btn btn-xs btn-success table-btns btnActions" action="1" status="1" sampling-id="' . $row->id . '" title="Restore"><i class="fa fa-unlock"></i></button>';
	                }

	                return $result;
	            })
	            ->addColumn('raw_validation_result', function($row){
	                $result = "";

	                if($row->validation_result == 1){
	                    $result .= 'OK';
	                }
	                else if($row->validation_result == 0){
	                    $result .= 'NG';
	                }
	                else{
	                	$result .= "--";
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

    public function save_sampling(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        // Add Sampling
		        if(!isset($request->sampling_id)){
		            $data = $request->all();

		            $rules = [
		                'monitoring_id' => 'required',
						'operator' => 'required',
						'station_id' => 'required',
						'po_no' => 'required',
						'series' => 'required',
						'sample_size' => 'required',
						'accept' => 'required',
						'reject' => 'required',
						'dppm' => 'required',
						'result' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                    Sampling::insert([
								'monitoring_id' => $request->monitoring_id,
								'operator' => $request->operator,
								'station_id' => $request->station_id,
								'po_no' => $request->po_no,
								'series' => $request->series,
								'sample_size' => $request->sample_size,
								'accept' => $request->accept,
								'reject' => $request->reject,
								'dppm' => $request->dppm,
								'result' => $request->result,
								'remarks' => $request->remarks,
								'validation_result' => $request->validation_result,
		                        'status' => 1,
		                        'created_by' => $_SESSION["rapidx_user_id"],
		                        'last_updated_by' => $_SESSION["rapidx_user_id"],
		                        'created_at' => date('Y-m-d H:i:s'),
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
		        // Edit Sampling
		        else{
		            $data = $request->all();

		            $rules = [
		                'monitoring_id' => 'required',
						'sampling_id' => 'required',
						'operator' => 'required',
						'station_id' => 'required',
						'po_no' => 'required',
						'series' => 'required',
						'sample_size' => 'required',
						'accept' => 'required',
						'reject' => 'required',
						'dppm' => 'required',
						'result' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                    Sampling::where('id', $request->sampling_id)
		                    	->where('logdel', 0)
		                    	->where('status', 1)
		                        ->update([
		                            'operator' => $request->operator,
									'station_id' => $request->station_id,
									'po_no' => $request->po_no,
									'series' => $request->series,
									'sample_size' => $request->sample_size,
									'accept' => $request->accept,
									'reject' => $request->reject,
									'dppm' => $request->dppm,
									'result' => $request->result,
									'remarks' => $request->remarks,
									'validation_result' => $request->validation_result,
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

    public function get_sampling_by_id(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        $data = [
		            'sampling_id' => $request->sampling_id,
		        ];

		        $rules = [
		            'sampling_id' => 'required',
		        ];

		        $validator = Validator::make($data, $rules);

		        if($validator->passes()){
		            $sampling_info = Sampling::select('samplings.*', 'users.name as operator_name', 'users.employee_id as operator_employee_id', 'stations.description as s_description')
	        			->leftJoin('users', 'samplings.operator', '=', 'users.id')
	        			->leftJoin('stations', 'samplings.station_id', '=', 'stations.id')
		            	->where('samplings.id', $request->sampling_id)
		            	->where('samplings.logdel', 0)->first();

		            return response()->json(['auth' => 1, 'sampling_info' => $sampling_info, 'result' => 1]);
		        }
		        else{
		            return response()->json(['auth' => 1, 'sampling_info' => null, 'result' => 0]);  
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

    public function sampling_action(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        // Change Sampling Status
	        if(isset($_SESSION["rapidx_user_id"])){
		        if($request->action == 1){
		            $data = [
		                'sampling_id' => $request->sampling_id,
		                'status' => $request->status,
		            ];

		            $rules = [
		                'sampling_id' => 'required',
		                'status' => 'required|numeric',
		            ];

		            $validator = Validator::make($data, $rules);

		            if($validator->passes()){
		                try {
		                    Sampling::where('id', $request->sampling_id)
		                    	->where('logdel', 0)
		                        ->update([
		                            'status' => $request->status,
		                            'last_updated_by' => $_SESSION["rapidx_user_id"],
		                            'updated_at' => date('Y-m-d H:i:s'),
		                        ]);

		                    return response()->json(['auth' => 1, 'result' => 1, 'error']);
		                } 
		                catch (Exception $e) {
		                    return response()->json(['auth' => 1, 'sampling_info' => null]); 
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

    public function get_cbo_sampling_by_stat(Request $request){
        date_default_timezone_set('Asia/Manila');

        if($request->ajax()){
        	if(isset($_SESSION["rapidx_user_id"])){
		        $search = $request->search;

		        if($search == ''){
		            $samplings = [];
		        }
		        else{
		            $samplings = Sampling::orderby('description','asc')->select('id','description')
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

		        foreach($samplings as $sampling){
		            $response[] = array(
		                "id" => $sampling->id,
		                "text" => $sampling->description,
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

    public function get_po_details(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        $data = [
		            'po_no' => $request->po_no,
		        ];

		        $rules = [
		            'po_no' => 'required',
		        ];

		        $validator = Validator::make($data, $rules);

		        if($validator->passes()){
		            $data = MaterialIssuanceSubSystem::where('po_no', $request->po_no)
                                        ->first();

		            return response()->json(['auth' => 1, 'data' => $data, 'result' => 1]);
		        }
		        else{
		            return response()->json(['auth' => 1, 'data' => null, 'result' => 0]);  
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

    public function get_operator_details(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        $data = [
		            'employee_id' => $request->employee_id,
		            'station_id' => $request->station_id,
		        ];

		        $rules = [
		            'employee_id' => 'required',
		            'station_id' => 'required',
		        ];

		        $validator = Validator::make($data, $rules);

		        if($validator->passes()){
		            $data = User::with([
				            		'user_station_details' => function($query) use ($request){
				            			$query->where('station_id', $request->station_id);
				            			$query->where('logdel', 0);
				            			$query->where('status', 1);
				            		}
			            		])
            					->where('employee_id', $request->employee_id)
            					->where('status', 1)
            					->where('logdel', 0)
                                ->first();

		            return response()->json(['auth' => 1, 'data' => $data, 'result' => 1]);
		        }
		        else{
		            return response()->json(['auth' => 1, 'data' => null, 'result' => 0]);  
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
