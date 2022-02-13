<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class RouteController extends Controller
{
    public function dashboard(){
    	if(Auth::check()){
    		if(Auth::user()->user_level == 1 || Auth::user()->user_level == 2){
    			return view('admin_dashboard');
    		}
            else{
                return view('branch.dashboard');   
            }
    	}
    	else{
    		return redirect()->route('session_expired');
    	}
    }

    public function users(){
    	if(Auth::check()){
    		if(Auth::user()->user_level == 1){
    			return view('users');
    		}
    		else{
    			return redirect('dashboard');
    		}
    	}
    	else{
    		return redirect()->route('session_expired');
    	}
    }

    public function lines(){
        if(Auth::check()){
            return view('lines');
        }
        else{
            return redirect()->route('session_expired');
        }
    }

    public function stations(){
        if(Auth::check()){
            return view('stations');
        }
        else{
            return redirect()->route('session_expired');
        }
    }

    public function monitoring(){
        if(Auth::check()){
            return view('monitoring');
        }
        else{
            return redirect()->route('session_expired');
        }
    }

    public function reference_types(){
        if(Auth::check()){
            return view('reference_types');
        }
        else{
            return redirect()->route('session_expired');
        }
    }
}
