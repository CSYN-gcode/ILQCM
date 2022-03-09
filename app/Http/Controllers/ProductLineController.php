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
use App\Model\ProductLine;

// PACKAGE
use DataTables;

class ProductLineController extends Controller
{
    //View ProductLines
    public function view_product_lines(Request $request){
        if($request->ajax()){
	        $data = ProductLine::where('logdel', 0)
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
	            ->addColumn('raw_family', function($row){
	                $result = "";

	                if($row->family == 1){
	                    $result .= 'BGA/LGA';
	                }
	                else if($row->family == 2){
	                    $result .= 'BGA-FP';
	                }
	                else if($row->family == 3){
	                    $result .= 'Probe Pin';
	                }
	                else if($row->family == 4){
	                    $result .= 'QF/TSOP/SMPO';
	                }

	                return $result;
	            })
	            ->addColumn('raw_action', function($row){
	                $result = '';
	                if($row->status == 1){
	                    $result .= '<button type="button" class="btn btn-xs btn-primary table-btns btnEditProductLine" product-line-id="' . $row->id . '"><i class="fa fa-edit" title="Edit"></i></button>';

	                    $result .= ' <button type="button" class="btn btn-xs btn-danger table-btns btnActions" action="1" status="2" product-line-id="' . $row->id . '" title="Archive"><i class="fa fa-lock"></i></button>';
	                }
	                else{
	                    $result .= ' <button type="button" class="btn btn-xs btn-success table-btns btnActions" action="1" status="1" product-line-id="' . $row->id . '" title="Restore"><i class="fa fa-unlock"></i></button>';
	                }

	                $family = "";

	                if($row->family == 1){
	                    $family = 'BGA/LGA';
	                }
	                else if($row->family == 2){
	                    $family = 'BGA-FP';
	                }
	                else if($row->family == 3){
	                    $family = 'Probe Pin';
	                }
	                else if($row->family == 4){
	                    $family = 'QF/TSOP/SMPO';
	                }

	                $result .= ' <button type="button" class="btn btn-xs btn-success table-btns btnSelectProductLine" product-line-id="' . $row->id . '" description="' . $row->description . '" family="' . $family . '"><i class="fa fa-arrow-right" title="Select"></i></button>';

	                return $result;
	            })
	            ->rawColumns(['raw_status', 'raw_family', 'raw_action'])
	            ->make(true);
        }
    	else{
    		abort(403);
    	}
    }

    public function save_product_line(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        // Add ProductLine
		        if(!isset($request->product_line_id)){
		            $data = $request->all();

		            $rules = [
		                'family' => 'required',
		                'description' => 'required|min:2',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                	$product_line_info = ProductLine::where("family", $request->family)
		                	->where("description", $request->description)
		                	->first();
		                	if($product_line_info == null){
			                    ProductLine::insert([
			                        'family' => $request->family,
			                        'description' => $request->description,
			                        'status' => 1,
			                        'created_by' => $_SESSION["rapidx_user_id"],
			                        'last_updated_by' => $_SESSION["rapidx_user_id"],
			                        'created_at' => date('Y-m-d H:i:s'),
			                        'updated_at' => date('Y-m-d H:i:s'),
			                    ]);
			                    return response()->json(['auth' => 1, 'result' => 1, 'error' => null]);
							}
		                	else{
		                		return response()->json(['auth' => 1, 'result' => 0, 'error' => ["description" => "The description has already been taken."]]);
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
		        // Edit ProductLine
		        else{
		            $data = $request->all();

		            $rules = [
		                'product_line_id' => 'required|numeric',
		                'description' => 'required|min:2',
		                'family' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                	$product_line_info = ProductLine::where("family", $request->family)
		                	->where("id", "!=", $request->product_line_id)
		                	->where("description", $request->description)
		                	->first();

		                	if($product_line_info == null){
			                    ProductLine::where('id', $request->product_line_id)
			                    	->where('logdel', 0)
			                    	->where('status', 1)
			                        ->update([
			                            'family' => $request->family,
			                            'description' => $request->description,
			                            'last_updated_by' => $_SESSION["rapidx_user_id"],
			                            'updated_at' => date('Y-m-d H:i:s'),
			                        ]);
			                    return response()->json(['auth' => 1, 'result' => 1, 'error' => null]);
							}
		                	else{
		                		return response()->json(['auth' => 1, 'result' => 0, 'error' => ["description" => "The description has already been taken."]]);
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

    public function get_product_line_by_id(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        $data = [
		            'product_line_id' => $request->product_line_id,
		        ];

		        $rules = [
		            'product_line_id' => 'required',
		        ];

		        $validator = Validator::make($data, $rules);

		        if($validator->passes()){
		            $product_line_info = ProductLine::where('id', $request->product_line_id)->where('logdel', 0)->first();

		            return response()->json(['auth' => 1, 'product_line_info' => $product_line_info, 'result' => 1]);
		        }
		        else{
		            return response()->json(['auth' => 1, 'product_line_info' => null, 'result' => 0]);  
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

    public function product_line_action(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        // Change ProductLine Status
	        if(isset($_SESSION["rapidx_user_id"])){
		        if($request->action == 1){
		            $data = [
		                'product_line_id' => $request->product_line_id,
		                'status' => $request->status,
		            ];

		            $rules = [
		                'product_line_id' => 'required',
		                'status' => 'required|numeric',
		            ];

		            $validator = Validator::make($data, $rules);

		            if($validator->passes()){
		                try {
		                    ProductLine::where('id', $request->product_line_id)
		                    	->where('logdel', 0)
		                        ->update([
		                            'status' => $request->status,
		                            'last_updated_by' => $_SESSION["rapidx_user_id"],
		                            'updated_at' => date('Y-m-d H:i:s'),
		                        ]);

		                    return response()->json(['auth' => 1, 'result' => 1, 'error']);
		                } 
		                catch (Exception $e) {
		                    return response()->json(['auth' => 1, 'product_line_info' => null]); 
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

    public function get_cbo_product_line_by_stat(Request $request){
        date_default_timezone_set('Asia/Manila');

        if($request->ajax()){
        	if(isset($_SESSION["rapidx_user_id"])){
		        $search = $request->search;

		        if($search == ''){
		            $product_lines = [];
		        }
		        else{
		            $product_lines = ProductLine::orderby('description','asc')->select('id','description')
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

		        foreach($product_lines as $product_line){
		            $response[] = array(
		                "id" => $product_line->id,
		                "text" => $product_line->description,
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

    public function get_cbo_product_line_by_family(Request $request){
        date_default_timezone_set('Asia/Manila');

        if($request->ajax()){
	        $search = $request->search;

	        if($search == ''){
	            $product_lines = [];
	        }
	        else{
	            $product_lines = ProductLine::orderby('description','asc')->select('id','description')
	                        ->where('description', 'like', '%' . $search . '%')
	                        ->where('family', $request->family)
	                        ->where('status', 1)
	                        ->where('logdel', 0)
	                        ->get();
	        }

	        $response = array();
	        $response[] = array(
                "id" => '',
                "text" => '',
            );

	        foreach($product_lines as $product_line){
	            $response[] = array(
	                "id" => $product_line->id,
	                "text" => $product_line->description,
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
