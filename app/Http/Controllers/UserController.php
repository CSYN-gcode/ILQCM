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
use App\Model\UserStation;
use App\Model\UserSeries;

// PACKAGE
use DataTables;
use QrCode;

class UserController extends Controller
{
    //View Users
    public function view_users(Request $request){
        if($request->ajax()){
	        $data = User::with([
		            		'user_station_details' => function($query){
		            			$query->where('logdel', 0);
		            			$query->where('status', 1);
		            		},
		            		'user_station_details.station_info' => function($query){
		            			$query->where('logdel', 0);
		            			$query->where('status', 1);
		            		},

		            		'user_series_details' => function($query){
		            			$query->where('logdel', 0);
		            			$query->where('status', 1);
		            		},
		            		'user_series_details.series_info' => function($query){
		            			$query->where('logdel', 0);
		            			$query->where('status', 1);
		            		},
		            	])
	        			->where('logdel', 0)
	        			->where('status', $request->status)
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
	            ->addColumn('raw_position', function($row){
	                $result = "";

	                if($row->position == 1){
	                    $result .= 'QC';
	                }
	                else if($row->position == 2){
	                    $result .= 'QC Supervisor';
	                }

	                return $result;
	            })
	            ->addColumn('raw_action', function($row){
	                $result = '';
	                if($row->status == 1){
	                    $result .= '<button type="button" class="btn btn-xs btn-primary table-btns btnEditUser" user-id="' . $row->id . '"><i class="fa fa-edit" title="Edit"></i></button>';

	                    $result .= ' <button type="button" class="btn btn-xs btn-danger table-btns btnActions" action="1" status="2" user-id="' . $row->id . '" title="Archive"><i class="fa fa-lock"></i></button>';

	                    $result .= ' <button type="button" class="btn btn-xs btn-success table-btns btnGenerateQRCode" user-id="' . $row->id . '" title="Generate QR Code"><i class="fa fa-qrcode"></i></button>';
	                }
	                else{
	                    $result .= ' <button type="button" class="btn btn-xs btn-success table-btns btnActions" action="1" status="1" user-id="' . $row->id . '" title="Restore"><i class="fa fa-unlock"></i></button>';
	                }

	                return $result;
	            })
	            ->rawColumns(['raw_status', 'raw_position', 'raw_action'])
	            ->make(true);
        }
    	else{
    		abort(403);
    	}
    }

    public function save_user(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        // Add User
		        if(!isset($request->user_id)){
		            $data = $request->all();

		            $rules = [
		                'name' => 'required|min:4|unique:users',
		                'email' => 'required|min:4|unique:users',
		                'employee_id' => 'required|min:2|unique:users',
		                'position' => 'required',
		                'station_ids' => 'required',
		                'series_ids' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                	try {
		                		DB::beginTransaction();
			                    $user_id = User::insertGetId([
			                        'name' => $request->name,
			                        'email' => $request->email,
			                        'employee_id' => $request->employee_id,
			                        'position' => $request->position,
			                        'status' => 1,
			                        'created_by' => $_SESSION["rapidx_user_id"],
			                        'last_updated_by' => $_SESSION["rapidx_user_id"],
			                        'created_at' => date('Y-m-d H:i:s'),
			                        'updated_at' => date('Y-m-d H:i:s'),
			                    ]);

			                    if(count($request->station_ids) > 0){
			                    	for($index = 0; $index < count($request->station_ids); $index++){
				                    	UserStation::insert([
					                        'user_id' => $user_id,
					                        'station_id' => $request->station_ids[$index],
					                        'status' => 1,
					                        'created_by' => $_SESSION["rapidx_user_id"],
					                        'last_updated_by' => $_SESSION["rapidx_user_id"],
					                        'created_at' => date('Y-m-d H:i:s'),
					                        'updated_at' => date('Y-m-d H:i:s'),
					                    ]);
			                    	}
			                    }

			                    if(count($request->series_ids) > 0){
			                    	for($index = 0; $index < count($request->series_ids); $index++){
				                    	UserSeries::insert([
					                        'user_id' => $user_id,
					                        'series_id' => $request->series_ids[$index],
					                        'status' => 1,
					                        'created_by' => $_SESSION["rapidx_user_id"],
					                        'last_updated_by' => $_SESSION["rapidx_user_id"],
					                        'created_at' => date('Y-m-d H:i:s'),
					                        'updated_at' => date('Y-m-d H:i:s'),
					                    ]);
			                    	}
			                    }

			                    DB::commit();
		                    	return response()->json(['auth' => 1, 'result' => 1, 'error' => null]);
		                	} catch (Exception $e) {
		                		DB::rollback();
		                		return response()->json(['auth' => 1, 'result' => 0, 'error' => $e->messages()]); 
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
		        // Edit User
		        else{
		            $data = $request->all();

		            $rules = [
		                'user_id' => 'required|numeric',
		                'name' => 'required|min:2|unique:users,name,' . $request->user_id,
		                'email' => 'required|min:2|unique:users,email,' . $request->user_id,
		                'employee_id' => 'required|min:2|unique:users,employee_id,' . $request->user_id,
		                'position' => 'required|numeric',
		                'station_ids' => 'required',
		                'series_ids' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                	try {
		                		DB::beginTransaction();
			                    User::where('id', $request->user_id)
			                    	->where('logdel', 0)
			                    	->where('status', 1)
			                        ->update([
			                            'name' => $request->name,
			                            'email' => $request->email,
			                            'employee_id' => $request->employee_id,
			                            'position' => $request->position,
			                            'last_updated_by' => $_SESSION["rapidx_user_id"],
			                            'updated_at' => date('Y-m-d H:i:s'),
			                        ]);

			                    if(count($request->station_ids) > 0){
			                    	UserStation::where('user_id', $request->user_id)
			                    	->delete();

			                    	for($index = 0; $index < count($request->station_ids); $index++){
				                    	UserStation::insert([
					                        'user_id' => $request->user_id,
					                        'station_id' => $request->station_ids[$index],
					                        'status' => 1,
					                        'created_by' => $_SESSION["rapidx_user_id"],
					                        'last_updated_by' => $_SESSION["rapidx_user_id"],
					                        'created_at' => date('Y-m-d H:i:s'),
					                        'updated_at' => date('Y-m-d H:i:s'),
					                    ]);
			                    	}
			                    }

			                    if(count($request->series_ids) > 0){
			                    	UserSeries::where('user_id', $request->user_id)
			                    	->delete();

			                    	for($index = 0; $index < count($request->series_ids); $index++){
				                    	UserSeries::insert([
					                        'user_id' => $request->user_id,
					                        'series_id' => $request->series_ids[$index],
					                        'status' => 1,
					                        'created_by' => $_SESSION["rapidx_user_id"],
					                        'last_updated_by' => $_SESSION["rapidx_user_id"],
					                        'created_at' => date('Y-m-d H:i:s'),
					                        'updated_at' => date('Y-m-d H:i:s'),
					                    ]);
			                    	}
			                    }

			                    DB::commit();
		                    	return response()->json(['auth' => 1, 'result' => 1, 'error' => null]);
		                	} catch (Exception $e) {
		                		DB::rollback();
		                		return response()->json(['auth' => 1, 'result' => 0, 'error' => $e->messages()]); 
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

    public function get_user_by_id(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        $data = [
		            'user_id' => $request->user_id,
		        ];

		        $rules = [
		            'user_id' => 'required',
		        ];

		        $validator = Validator::make($data, $rules);

		        if($validator->passes()){
		            $user_info = User::with([
		            		'user_station_details' => function($query){
		            			$query->where('logdel', 0);
		            			$query->where('status', 1);
		            		},
		            		'user_station_details.station_info' => function($query){
		            			$query->where('logdel', 0);
		            			$query->where('status', 1);
		            		},

		            		'user_series_details' => function($query){
		            			$query->where('logdel', 0);
		            			$query->where('status', 1);
		            		},
		            		'user_series_details.series_info' => function($query){
		            			$query->where('logdel', 0);
		            			$query->where('status', 1);
		            		},
		            	])
		            	->where('id', $request->user_id)
		            	->where('logdel', 0)
		            	->first();

		            $qrcode = QrCode::format('png')
                            ->size(200)->errorCorrection('H')
                            ->generate($user_info->employee_id);

		            return response()->json(['auth' => 1, 'user_info' => $user_info, 'result' => 1, 'qrcode' => "data:image/png;base64," . base64_encode($qrcode)]);
		        }
		        else{
		            return response()->json(['auth' => 1, 'user_info' => null, 'result' => 0, 'qrcode' => ""]);  
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

    public function user_action(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        // Change User Status
	        if(isset($_SESSION["rapidx_user_id"])){
		        if($request->action == 1){
		            $data = [
		                'user_id' => $request->user_id,
		                'status' => $request->status,
		            ];

		            $rules = [
		                'user_id' => 'required',
		                'status' => 'required|numeric',
		            ];

		            $validator = Validator::make($data, $rules);

		            if($validator->passes()){
		                try {
		                    User::where('id', $request->user_id)
		                    	->where('logdel', 0)
		                        ->update([
		                            'status' => $request->status,
		                            'last_updated_by' => $_SESSION["rapidx_user_id"],
		                            'updated_at' => date('Y-m-d H:i:s'),
		                        ]);

		                    return response()->json(['auth' => 1, 'result' => 1, 'error']);
		                } 
		                catch (Exception $e) {
		                    return response()->json(['auth' => 1, 'user_info' => null]); 
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

    public function get_cbo_user_by_stat(Request $request){
        date_default_timezone_set('Asia/Manila');

        if($request->ajax()){
	        $search = $request->search;

	        if($search == ''){
	            $users = [];
	        }
	        else{
	            $users = User::orderby('name','asc')->select('id','name', 'employee_id')
	                        ->where('name', 'like', '%' . $search . '%')
	                        ->orWhere('employee_id', 'like', '%' . $search . '%')
	                        ->where('status', 1)
	                        ->where('logdel', 0)
	                        ->get();
	        }

	        $response = array();
	        $response[] = array(
                "id" => '',
                "text" => '',
            );

	        foreach($users as $user){
	            $response[] = array(
	                "id" => $user->id,
	                "text" => $user->name . ' (' . $user->employee_id . ')',
	            );
	        }

	        echo json_encode($response);
	        exit;
        }
    	else{
    		abort(403);
    	}
    }
}
