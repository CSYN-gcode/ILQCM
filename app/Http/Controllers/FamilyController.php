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

use App\Model\Family;
use DataTables;

class FamilyController extends Controller
{
    //View Families
    public function viewFamily(Request $request){
        if($request->ajax()){
	        // $data = Strategic::where('logdel', 0)
	        // 			->where('status', $request->status)
        	// 			->get();

            $data = DB::connection('mysql')
                    ->table('families')
                    ->select(
                        'families.*'
                    )
                    ->where('families.status', $request->status)
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
	                    $result .= '<button type="button" class="btn btn-xs btn-primary table-btns btnEditFamily" id="' . $row->id . '"><i class="fa fa-edit" title="Edit"></i></button>';

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

    public function saveFamily(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        // Add Family
		        if(!isset($request->id)){
		            $data = [
		                'family_name' => $request->family_name,
		            ];

		            $rules = [
		                'family_name' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                    Family::insert([
		                        'family_name' => $request->family_name,
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
		        }else{ // Edit family
		            $data = [
		                'family_name' => $request->family_name,
		            ];

		            $rules = [
		                'family_name' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                    Family::where('id', $request->id)
		                    	->where('logdel', 0)
		                    	->where('status', 1)
		                        ->update([
		                            'family_name' => $request->family_name,
		                            'last_updated_by' => $_SESSION["rapidx_user_id"],
		                            'updated_at' => date('Y-m-d H:i:s'),
		                        ]);
		                    return response()->json(['auth' => 1, 'result' => 1, 'error' => null]);
		                }else{
		                    return response()->json(['auth' => 1, 'result' => 0, 'error' => $validator->messages()]);
		                }
		            }catch(\Exception $e) {
		                return response()->json(['auth' => 1, 'result' => 0, 'error' => $e]);
		            }
		        }
	        }else{
	        	return response()->json(['auth' => 0, 'result' => 0, 'error' => null]);
	        }
	    }else{
    		abort(403);
    	}
    }

    public function getFamilyById(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
                $family_info = DB::connection('mysql')
                                    ->table('families')
                                    ->select(
                                        'families.*'
                                    )
                                    // ->when($request->id, function ($query) use ($request){
                                    //     return $query ->where('families.id', $request->id);
                                    // })
                                    ->where('families.logdel', 0)
                                    ->where('families.status', 1)
                                    ->when($request->id, function ($query) use ($request){
                                        return $query->where('families.id', $request->id)->first();
                                    }, function ($q) {
                                        return $q->get();
                                    });

                return response()->json(['auth' => 1, 'family_info' => $family_info, 'result' => 1]);
		    }else{
	        	return response()->json(['auth' => 0, 'result' => 0, 'error' => null]);
		    }
		}else{
    		abort(403);
    	}
    }

    public function familyAction(Request $request){
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
		                    Family::where('id', $request->id)
		                    	->where('logdel', 0)
		                        ->update([
		                            'status' => $request->status,
		                            'last_updated_by' => $_SESSION["rapidx_user_id"],
		                            'updated_at' => date('Y-m-d H:i:s'),
		                        ]);

		                    return response()->json(['auth' => 1, 'result' => 1, 'error']);
		                }catch (Exception $e) {
		                    return response()->json(['auth' => 1, 'family_info' => null]);
		                }
		            }else{
		                return response()->json(['auth' => 1, 'result' => 0, 'error' => $validator->messages()]);
		            }
		        }
	        }else{ // Session Expired
	        	return response()->json(['auth' => 0, 'result' => 0, 'error' => null]);
		    }
		}else{
    		abort(403);
    	}
    }
}
