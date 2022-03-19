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
use App\Model\Station;
use App\Model\StationSeries;

// PACKAGE
use DataTables;

class StationController extends Controller
{
    //View Stations
    public function view_stations(Request $request){
        if($request->ajax()){
	        $data = Station::with([
		            		'station_series_details' => function($query){
		            			$query->where('logdel', 0);
		            			$query->where('status', 1);
		            		},
		            		'station_series_details.series_info' => function($query){
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
	            ->addColumn('raw_action', function($row){
	                $result = '';
	                if($row->status == 1){
	                    $result .= '<button type="button" class="btn btn-xs btn-primary table-btns btnEditStation" station-id="' . $row->id . '"><i class="fa fa-edit" title="Edit"></i></button>';

	                    $result .= ' <button type="button" class="btn btn-xs btn-danger table-btns btnActions" action="1" status="2" station-id="' . $row->id . '" title="Archive"><i class="fa fa-lock"></i></button>';
	                }
	                else{
	                    $result .= ' <button type="button" class="btn btn-xs btn-success table-btns btnActions" action="1" status="1" station-id="' . $row->id . '" title="Restore"><i class="fa fa-unlock"></i></button>';
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

    public function save_station(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        // Add Station
		        if(!isset($request->station_id)){
		            $data = $request->all();

		            $rules = [
		                'description' => 'required|min:2|unique:stations',
		                'series_ids' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                	try {
			                    $station_id = Station::insertGetId([
			                        'description' => $request->description,
			                        'status' => 1,
			                        'created_by' => $_SESSION["rapidx_user_id"],
			                        'last_updated_by' => $_SESSION["rapidx_user_id"],
			                        'created_at' => date('Y-m-d H:i:s'),
			                        'updated_at' => date('Y-m-d H:i:s'),
			                    ]);

			                    if(count($request->series_ids) > 0){
			                    	for($index = 0; $index < count($request->series_ids); $index++){
				                    	StationSeries::insert([
					                        'station_id' => $station_id,
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
		        // Edit Station
		        else{
		            $data = $request->all();

		            $rules = [
		                'station_id' => 'required|numeric',
		                'description' => 'required|min:2|unique:stations,description,' . $request->station_id,
		                'series_ids' => 'required',
		            ];

		            $validator = Validator::make($data, $rules);

		            try {
		                if($validator->passes()){
		                	try {
		                		DB::beginTransaction();
			                    Station::where('id', $request->station_id)
			                    	->where('logdel', 0)
			                    	->where('status', 1)
			                        ->update([
			                            'description' => $request->description,
			                            'last_updated_by' => $_SESSION["rapidx_user_id"],
			                            'updated_at' => date('Y-m-d H:i:s'),
			                        ]);

			                    if(count($request->series_ids) > 0){
			                    	StationSeries::where('station_id', $request->station_id)
			                    	->delete();

			                    	for($index = 0; $index < count($request->series_ids); $index++){
				                    	StationSeries::insert([
					                        'station_id' => $request->station_id,
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

    public function get_station_by_id(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();
        if($request->ajax()){
	        if(isset($_SESSION["rapidx_user_id"])){
		        $data = [
		            'station_id' => $request->station_id,
		        ];

		        $rules = [
		            'station_id' => 'required',
		        ];

		        $validator = Validator::make($data, $rules);

		        if($validator->passes()){
		            $station_info = Station::with([
		            				'station_series_details' => function($query){
				            			$query->where('logdel', 0);
				            			$query->where('status', 1);
				            		},
				            		'station_series_details.series_info' => function($query){
				            			$query->where('logdel', 0);
				            			$query->where('status', 1);
				            		},
		            			])
		            			->where('id', $request->station_id)
		            			->where('logdel', 0)
		            			->first();

		            return response()->json(['auth' => 1, 'station_info' => $station_info, 'result' => 1]);
		        }
		        else{
		            return response()->json(['auth' => 1, 'station_info' => null, 'result' => 0]);  
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

    public function station_action(Request $request){
        date_default_timezone_set('Asia/Manila');
        session_start();

        if($request->ajax()){
	        // Change Station Status
	        if(isset($_SESSION["rapidx_user_id"])){
		        if($request->action == 1){
		            $data = [
		                'station_id' => $request->station_id,
		                'status' => $request->status,
		            ];

		            $rules = [
		                'station_id' => 'required',
		                'status' => 'required|numeric',
		            ];

		            $validator = Validator::make($data, $rules);

		            if($validator->passes()){
		                try {
		                    Station::where('id', $request->station_id)
		                    	->where('logdel', 0)
		                        ->update([
		                            'status' => $request->status,
		                            'last_updated_by' => $_SESSION["rapidx_user_id"],
		                            'updated_at' => date('Y-m-d H:i:s'),
		                        ]);

		                    return response()->json(['auth' => 1, 'result' => 1, 'error']);
		                } 
		                catch (Exception $e) {
		                    return response()->json(['auth' => 1, 'station_info' => null]); 
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

    public function get_cbo_station_by_stat(Request $request){
        date_default_timezone_set('Asia/Manila');

        if($request->ajax()){
	        $search = $request->search;

	        if($search == ''){
	            $stations = [];
	        }
	        else{
	            $stations = Station::orderby('description','asc')->select('id','description')
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

	        foreach($stations as $station){
	            $response[] = array(
	                "id" => $station->id,
	                "text" => $station->description,
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
