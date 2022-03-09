<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class RouteController extends Controller
{
    public function dashboard(){
    	session_start();
        if(isset($_SESSION["rapidx_user_id"])){
			return view('admin_dashboard');
    	}
    	else{
    		return redirect()->route('session_expired');
    	}
    }

    public function users(){
    	session_start();
        if(isset($_SESSION["rapidx_user_id"])){
    		return view('users');
    	}
    	else{
    		return redirect()->route('session_expired');
    	}
    }

    public function lines(){
        session_start();
        if(isset($_SESSION["rapidx_user_id"])){
            return view('lines');
        }
        else{
            return redirect()->route('session_expired');
        }
    }

    public function product_lines(){
        session_start();
        if(isset($_SESSION["rapidx_user_id"])){
            return view('product_lines');
        }
        else{
            return redirect()->route('session_expired');
        }
    }

    public function stations(){
        session_start();
        if(isset($_SESSION["rapidx_user_id"])){
            return view('stations');
        }
        else{
            return redirect()->route('session_expired');
        }
    }

    public function machines(){
        session_start();
        if(isset($_SESSION["rapidx_user_id"])){
            return view('machines');
        }
        else{
            return redirect()->route('session_expired');
        }
    }

    public function monitoring(){
        session_start();
        if(isset($_SESSION["rapidx_user_id"])){
            return view('monitoring');
        }
        else{
            return redirect()->route('session_expired');
        }
    }

    public function view_monitoring(){
        session_start();
        if(isset($_SESSION["rapidx_user_id"])){
            return view('view_monitoring');
        }
        else{
            return redirect()->route('session_expired');
        }
    }

    public function reference_types(){
        session_start();
        if(isset($_SESSION["rapidx_user_id"])){
            return view('reference_types');
        }
        else{
            return redirect()->route('session_expired');
        }
    }
}
