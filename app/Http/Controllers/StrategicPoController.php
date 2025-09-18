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

use App\Model\Strategic;
use App\Model\Series;
use DataTables;

class StrategicPoController extends Controller
{
    //View Serieses
    public function viewStrategicPo(Request $request){
        if($request->ajax()){
	        // $data = Strategic::where('logdel', 0)
	        // 			->where('status', $request->status)
        	// 			->get();

            $data = DB::connection('mysql')
                    ->table('strategic_po')
                    ->join('serieses', 'strategic_po.series_name', '=', 'serieses.id')
                    ->select(
                        'strategic_po.*',
                        'serieses.description AS series_description',
                    )
                    ->where('strategic_po.status', $request->status)
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
                ->addColumn('first_created_by', function($row){
                    if($row->created_by != '' || $row->created_by != null){
                        $rapidx_user_created_by = DB::connection('mysql_rapidx')
                                                    ->table('users')
                                                    ->select('id', 'name')
                                                    ->where('id', $row->created_by)
                                                    ->get();
                    }
	                return $rapidx_user_created_by[0]->name;
	            })
                ->addColumn('latest_updated_by', function($row){
                    if($row->last_updated_by != '' || $row->last_updated_by != null){
                        $rapidx_user_last_updated_by = DB::connection('mysql_rapidx')
                                                        ->table('users')
                                                        ->select('id', 'name')
                                                        ->where('id', $row->last_updated_by)
                                                        ->get();
                    }
	                return $rapidx_user_last_updated_by[0]->name;
	            })
	            ->addColumn('raw_action', function($row){
	                $result = '';
	                if($row->status == 1){
	                    $result .= '<button type="button" class="btn btn-xs btn-primary table-btns btnEditStrategicPo" id="' . $row->id . '"><i class="fa fa-edit" title="Edit"></i></button>';

	                    $result .= ' <button type="button" class="btn btn-xs btn-danger table-btns btnActions" action="1" status="2" id="' . $row->id . '" title="Archive"><i class="fa fa-lock"></i></button>';
	                }
	                else{
	                    $result .= ' <button type="button" class="btn btn-xs btn-success table-btns btnActions" action="1" status="1" id="' . $row->id . '" title="Restore"><i class="fa fa-unlock"></i></button>';
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

    public function saveStrategicPo(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        // Add Series
		        if(!isset($request->id)){
		            $data = [
		                'po_number' => $request->po_number,
		                'series_name' => $request->series_name,
		            ];

		            $rules = [
		                'po_number' => 'required',
		                'series_name' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                    Strategic::insert([
		                        'po_number' => $request->po_number,
		                        'series_name' => $request->series_name,
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
		        // Edit Strategic
		        else{
		            $data = [
		                'po_number' => $request->po_number,
		                'series_name' => $request->series_name,
		            ];

		            $rules = [
		                'po_number' => 'required',
		                'series_name' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                    Strategic::where('id', $request->id)
		                    	->where('logdel', 0)
		                    	->where('status', 1)
		                        ->update([
		                            'po_number' => $request->po_number,
		                            'series_name' => $request->series_name,
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

    public function getStrategicPoById(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        $data = [
		            'id' => $request->id,
		        ];

		        $rules = [
		            'id' => 'required',
		        ];

		        $validator = Validator::make($data, $rules);

		        if($validator->passes()){
		            // $strategic_po_info = Strategic::where('id', $request->id)->where('logdel', 0)->first();

                    $strategic_po_info = DB::connection('mysql')
                                        ->table('strategic_po')
                                        ->join('serieses', 'strategic_po.series_name', '=', 'serieses.id')
                                        ->select(
                                            'strategic_po.*',
                                            'serieses.description AS series_description',
                                        )
                                        ->where('strategic_po.id', $request->id)->where('strategic_po.logdel', 0)->first();

		            return response()->json(['auth' => 1, 'strategic_po_info' => $strategic_po_info, 'result' => 1]);
		        }
		        else{
		            return response()->json(['auth' => 1, 'strategic_po_info' => null, 'result' => 0]);
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

    public function strategicAction(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        // Change Series Status
	        if(isset($_SESSION["rapidx_user_id"])){
		        if($request->action == 1){
		            $data = [
		                'id' => $request->id,
		                'status' => $request->status,
		            ];

		            $rules = [
		                'id' => 'required',
		                'status' => 'required|numeric',
		            ];

		            $validator = Validator::make($data, $rules);

		            if($validator->passes()){
		                try {
		                    Strategic::where('id', $request->id)
		                    	->where('logdel', 0)
		                        ->update([
		                            'status' => $request->status,
		                            'last_updated_by' => $_SESSION["rapidx_user_id"],
		                            'updated_at' => date('Y-m-d H:i:s'),
		                        ]);

		                    return response()->json(['auth' => 1, 'result' => 1, 'error']);
		                }
		                catch (Exception $e) {
		                    return response()->json(['auth' => 1, 'series_info' => null]);
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

    public function getSeriesNameByStat(Request $request){
        $system_one_emp_info = DB::connection('mysql_systemone_hris')
        ->table('tbl_EmployeeInfo')
        ->select('pkid', 'EmpNo')
        ->where('EmpNo', $request->emp_id)
        // ->where('EmpNo', $request->emp_no)
        // ->where('assembly_fvis_runcards.assembly_fvis_id', $fvi_data->id)
        ->get();

        // return $test;
        return response()->json(["result" => $system_one_emp_info]);
    }

    // public function get_cbo_series_by_stat(Request $request){
    //     date_default_timezone_set('Asia/Manila');

    //     if($request->ajax()){
	//         $search = $request->search;

	//         if($search == ''){
	//             $serieses = [];
	//         }
	//         else{
	//             $serieses = Series::orderby('description','asc')->select('id','description')
	//                         ->where('description', 'like', '%' . $search . '%')
	//                         ->where('status', 1)
	//                         ->where('logdel', 0)
	//                         ->get();
	//         }

	//         $response = array();
	//         $response[] = array(
    //             "id" => '',
    //             "text" => '',
    //         );

	//         foreach($serieses as $series){
	//             $response[] = array(
	//                 "id" => $series->id,
	//                 "text" => $series->description,
	//             );
	//         }

	//         echo json_encode($response);
	//         exit;
    //     }
    // 	else{
    // 		abort(403);
    // 	}
    // }
}
