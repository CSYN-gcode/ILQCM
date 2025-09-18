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

// PACKAGE
use DataTables;

class UserController extends Controller
{
    // Sign In
    public function sign_in(Request $request){
        date_default_timezone_set('Asia/Manila');

        if($request->ajax()){
	        $data = array(
	            'username' => $request->username,
	            'password' => $request->password,
	            'status' => 1,
	            'logdel' => 0,
	        );

	        $rules = [
	            'username' => 'required|min:4',
	            'password' => 'required|min:4'
	        ];

	        $validator = Validator::make($data, $rules);

	        try {
	            if($validator->passes()){
	                if(Auth::attempt($data)){
	                    
	                    $user_info = [
	                        'id' => Auth::user()->id,
	                        'name' => Auth::user()->name,
	                        'username' => Auth::user()->username,
	                        'user_level' => Auth::user()->user_level,
	                        'status' => Auth::user()->status,
	                    ];

	                    return response()->json([
	                        'result' => 1,
	                        'user_info' => $user_info,
	                    ]);
	                }
	                else{
	                    try{
	                        $user_info = User::where('username', $request->username)->first();

	                        return response()->json(['result' => 0, 'user_info' => $user_info]);
	                    }
	                    catch(\Exception $e) {
	                        DB::rollback();
	                        return response()->json(['result' => 0, 'error' => 'Login Failed!', 'user_info' => null]);  
	                    }
	                }
	            }
	            else{
	                try{
	                    $user_info = User::where('username', $request->username)->first();

	                    return response()->json(['result' => 0, 'user_info' => $user_info]);
	                }
	                catch(\Exception $e) {
	                    DB::rollback();
	                    return response()->json(['result' => 0, 'error' => $e, 'user_info' => null]);
	                }
	            }
	        } 
	        catch (Exception $e) {
	            return response()->json(['result' => 0, 'error' => $e->messages(), 'user_info' => null]);
	        }
        }
    	else{
    		abort(403);
    	}

    }

    // Logout
    public function logout(Request $request){
    	if($request->ajax()){
	        Auth::logout();
	        session()->flush();
	        return response()->json(['result' => 1]);
    	}
    	else{
    		abort(403);
    	}
    }

    //View Users
    public function view_users(Request $request){
        if($request->ajax()){
	        $data = User::where('logdel', 0)
	        			->where('status', $request->status)
	        			->get();

	        return DataTables::of($data)
	            ->addColumn('raw_status', function($row){
	                $result = "";

	                if($row->status == 1){
	                    $result .= '<span class="badge badge-pill bg-success">Active</span>';
	                }
	                else if($row->status == 2){
	                    $result .= '<span class="badge badge-pill bg-danger">Inactive</span>';
	                }
	                else if($row->status == 3){
	                    $result .= '<span class="badge badge-pill bg-warning">Disabled</span>';
	                }

	                return $result;
	            })
	            ->addColumn('raw_action', function($row){
	                $result = '';
	                if($row->status == 1){
	                    $result .= '<button type="button" class="btn btn-xs btn-primary table-btns btnEditUser" user-id="' . $row->id . '"><i class="fa fa-edit" title="Edit"></i></button>';

	                    $result .= ' <button type="button" class="btn btn-xs btn-danger table-btns btnActions" action="1" status="2" user-id="' . $row->id . '" title="Deactivate"><i class="fa fa-lock"></i></button>';

	                    $result .= ' <button type="button" class="btn btn-xs btn-warning table-btns btnActions" action="2" status="1" user-id="' . $row->id . '" title="Reset Password"><i class="fa fa-history"></i></button>';
	                }
	                else{
	                    $result .= ' <button type="button" class="btn btn-xs btn-success table-btns btnActions" action="1" status="1" user-id="' . $row->id . '" title="Activate"><i class="fa fa-unlock"></i></button>';
	                }

	                return $result;
	            })
	            ->addColumn('raw_user_level', function($row){
	                $result = "";

	                if($row->user_level == 1){
	                    $result = 'Administrator';
	                }
	                else if($row->user_level == 2){
	                    $result = 'Encoder';
	                }

	                return $result;
	            })
	            ->rawColumns(['raw_status', 'raw_action', 'raw_user_level'])
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
	        if(Auth::check()){
		        // Add User
		        if(!isset($request->user_id)){
		            $data = $request->all();

		            $rules = [
		                'name' => 'required|min:5|unique:users',
		                'username' => 'required|min:5|unique:users',
		                'email' => 'required|min:8|unique:users',
		                'user_level' => 'required|numeric',
		                // 'password' => 'required|min:8',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                    User::insert([
		                        'name' => $request->name,
		                        'username' => $request->username,
		                        'email' => $request->email,
		                        'user_level' => $request->user_level,
		                        'password' => Hash::make('jct12345'),
		                        'status' => 1,
		                        'attempt' => 0,
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
		        // Edit User
		        else{
		            $data = $request->all();

		            $rules = [
		                'user_id' => 'required|numeric',
		                'name' => 'required|min:5|unique:users,name,' . $request->user_id,
		                'username' => 'required|min:5|unique:users,username,' . $request->user_id,
		                'email' => 'required|min:8|unique:users,email,' . $request->user_id,
		                'user_level' => 'required|numeric',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                    User::where('id', $request->user_id)
		                    	->where('logdel', 0)
		                    	->where('status', 1)
		                        ->update([
		                            'name' => $request->name,
		                            'username' => $request->username,
		                            'email' => $request->email,
		                            'user_level' => $request->user_level,
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

    public function get_user_by_id(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        if($request->ajax()){
	        if(Auth::check()){
		        $data = [
		            'user_id' => $request->user_id,
		        ];

		        $rules = [
		            'user_id' => 'required',
		        ];

		        $validator = Validator::make($data, $rules);

		        if($validator->passes()){
		            $user_info = User::where('id', $request->user_id)->where('logdel', 0)->first();

		            return response()->json(['auth' => 1, 'user_info' => $user_info, 'result' => 1]);
		        }
		        else{
		            return response()->json(['auth' => 1, 'user_info' => null, 'result' => 0]);  
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
	        if(Auth::check()){
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
		        // Reset Password
		        else if($request->action == 2){
		            $data = [
		                'user_id' => $request->user_id,
		            ];

		            $rules = [
		                'user_id' => 'required',
		            ];

		            $password = '';

		            $validator = Validator::make($data, $rules);

		            if($validator->passes()){
		                try {
		                    $password = Hash::make('jct12345');
		                    User::where('id', $request->user_id)
	                    		->where('logdel', 0)
		                        ->update([
		                            'password' => $password,
		                            'updated_at' => date('Y-m-d H:i:s'),
		                        ]);

		                    return response()->json(['auth' => 1, 'result' => 1]);
		                } 
		                catch (Exception $e) {
		                    return response()->json(['auth' => 1, 'result' => 0]);   
		                }
		            }
		            else{
		                return response()->json(['auth' => 1, 'error' => $validator->messages(), 'password' => $password]);   
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

    public function change_password(Request $request){

        if($request->ajax()){
	        $data = $request->all();

	        $login_data = array(
	            'username' => Auth::user()->username,
	            'password' => $request->password,
	            'status' => 1,
	            'logdel' => 0,
	        );

	        $rules = [
	            'password' => 'required|min:4',
	            'new_password' => 'required|min:4',
	            'confirm_password' => 'required|min:4|same:new_password',
	        ];

	        $validator = Validator::make($data, $rules);

	        try {
            	if($validator->passes()){
            		if(Auth::attempt($login_data)){
			        	User::where('username', Auth::user()->username)
		        			->update([
		        				'password' => Hash::make($request->new_password),
		        			]);

		             	return response()->json(['result' => 1, 'login_success' => 1, 'auth' => 1]);
            		}
	                else{
	                	return response()->json(['result' => 0, 'login_success' => 0, 'auth' => 1]);
	                }
	            }
	            else{
	            	return response()->json(['result' => 0, 'error' => $validator->messages(), 'auth' => 1]);
	            }
	        } 
	        catch (Exception $e) {
	            return response()->json(['result' => 0, 'error' => $e->messages(), 'user_info' => null]);
	        }
        }
    	else{
    		abort(403);
    	}

    }

    public function count_users(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        if($request->ajax()){
	        if(Auth::check()){
	            $count = User::where('status', 1)->where('logdel', 0)->count();

	            return response()->json(['auth' => 1, 'count' => $count, 'result' => 1]);
		    }
		    else{
	        	return response()->json(['auth' => 0, 'result' => 0, 'error' => null, 'count' => 0]);
		    }
		}
    	else{
    		abort(403);
    	}
    }

}
