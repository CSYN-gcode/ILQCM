<?php

use Illuminate\Support\Facades\Route;

// MODEL
use App\Model\Monitoring;
use App\Model\Sampling;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//save_monitoring
Route::get('/link', function () {
    return 'link';
})->name('link');


Route::get('/', function () {
    return view('index');
})->name('login');

Route::get('/session_expired', function () {
    return view('session_expired');
})->name('session_expired');

// Route::get('/pats_ppd_dashboard', function () {
//     return view('pats_ppd_dashboard');
// })->name('pats_ppd_dashboard');

// Route::get('/dashboard', function () {
//     return view('cso.dashboard');
// })->name('dashboard');

// ROUTE CONTROLLER
Route::get('/dashboard', 'RouteController@dashboard')->name('dashboard');
Route::get('/user_logout', 'UserController@user_logout');

// Route::get('/pats_ppd_dashboard', 'RouteController@pats_ppd_dashboard')->name('pats_ppd_dashboard');
Route::get('/strategic_po', 'RouteController@strategic_po')->name('strategic_po');
Route::get('/serieses', 'RouteController@serieses')->name('serieses');
Route::get('/users', 'RouteController@users')->name('users');
Route::get('/lines', 'RouteController@lines')->name('lines');
Route::get('/product_lines', 'RouteController@product_lines')->name('product_lines');
Route::get('/stations', 'RouteController@stations')->name('stations');
Route::get('/machines', 'RouteController@machines')->name('machines');
Route::get('/monitoring', 'RouteController@monitoring')->name('monitoring');
Route::get('/monitoring_clark', 'RouteController@monitoring_clark')->name('monitoring_clark');
Route::get('/monitoring_v2', 'RouteController@monitoring_v2')->name('monitoring_v2');
Route::get('/samplings', 'RouteController@samplings')->name('samplings');
Route::get('/monitoring/{id}', function ($id) {
	session_start();
	if(isset($_SESSION["rapidx_user_id"])){
		$monitoring_info = Monitoring::select('monitorings.id as m_id', 'monitorings.product_line_id as m_product_line_id', 'line_id', 'monitorings.date_from as m_date_from', 'monitorings.date_to as m_date_to', 'work_week', 'shift', 'machine_id', 'qc_inspector', 'qc_checked_by', 'monitorings.status as m_status', 'lines.description as l_description', 'machines.description as m_description', 'uqi.name as uqi_name', 'uqi.employee_id as uqi_employee_id', 'qcb.name as qcb_name', 'qcb.employee_id as qcb_employee_id', 'pl.family', 'pl.description as pl_description')
			        ->leftJoin('lines', 'monitorings.line_id', '=', 'lines.id')
			        ->leftJoin('machines', 'monitorings.machine_id', '=', 'machines.id')
			        ->leftJoin('users as uqi', 'uqi.id', '=', 'monitorings.qc_inspector')
			        ->leftJoin('users as qcb', 'qcb.id', '=', 'monitorings.qc_checked_by')
			        ->leftJoin('product_lines as pl', 'pl.id', '=', 'monitorings.product_line_id')
		            ->where('monitorings.id', $id)
		            ->where('monitorings.status', 1)
		            ->where('monitorings.logdel', 0)
		            ->first();

		$sampling_no_prod_count = Sampling::where("no_production_date", date("Y-m-d"))
					->where("no_production_date", $monitoring_info->id)
					->where('status', 1)
					->where('logdel', 0)
					->count();

		if($monitoring_info != null){
    		return view('view_monitoring')->with(['id' => $id, 'monitoring_info' => $monitoring_info, 'sampling_no_prod_count' => $sampling_no_prod_count]);
		}
		else{
			return "Monitoring is not available.";
		}
    }
    else{
        return redirect()->route('session_expired');
    }
});
Route::get('/monitoring_clark/{id}', function ($id) {
	session_start();
	if(isset($_SESSION["rapidx_user_id"])){
		$monitoring_info = Monitoring::select('monitorings.id as m_id', 'monitorings.product_line_id as m_product_line_id', 'line_id', 'monitorings.date_from as m_date_from', 'monitorings.date_to as m_date_to', 'work_week', 'shift', 'machine_id', 'qc_inspector', 'qc_checked_by', 'monitorings.status as m_status', 'lines.description as l_description', 'machines.description as m_description', 'uqi.name as uqi_name', 'uqi.employee_id as uqi_employee_id', 'qcb.name as qcb_name', 'qcb.employee_id as qcb_employee_id', 'pl.family', 'pl.description as pl_description')
			        ->leftJoin('lines', 'monitorings.line_id', '=', 'lines.id')
			        ->leftJoin('machines', 'monitorings.machine_id', '=', 'machines.id')
			        ->leftJoin('users as uqi', 'uqi.id', '=', 'monitorings.qc_inspector')
			        ->leftJoin('users as qcb', 'qcb.id', '=', 'monitorings.qc_checked_by')
			        ->leftJoin('product_lines as pl', 'pl.id', '=', 'monitorings.product_line_id')
		            ->where('monitorings.id', $id)
		            ->where('monitorings.status', 1)
		            ->where('monitorings.logdel', 0)
		            ->first();

		$sampling_no_prod_count = Sampling::where("no_production_date", date("Y-m-d"))
					->where("no_production_date", $monitoring_info->id)
					->where('status', 1)
					->where('logdel', 0)
					->count();

		if($monitoring_info != null){
    		return view('view_monitoring_clark')->with(['id' => $id, 'monitoring_info' => $monitoring_info, 'sampling_no_prod_count' => $sampling_no_prod_count]);
		}
		else{
			return "Monitoring is not available.";
		}
    }
    else{
        return redirect()->route('session_expired');
    }
});

Route::get('/monitoring_v2/{id}', function ($id) {
	session_start();
	if(isset($_SESSION["rapidx_user_id"])){
		$monitoring_info = Monitoring::select('monitorings.id as m_id', 'monitorings.product_line_id as m_product_line_id', 'line_id', 'monitorings.date_from as m_date_from', 'monitorings.date_to as m_date_to', 'work_week', 'shift', 'machine_id', 'qc_inspector', 'qc_checked_by', 'monitorings.status as m_status', 'lines.description as l_description', 'machines.description as m_description', 'uqi.name as uqi_name', 'uqi.employee_id as uqi_employee_id', 'qcb.name as qcb_name', 'qcb.employee_id as qcb_employee_id', 'pl.family', 'pl.description as pl_description')
			        ->leftJoin('lines', 'monitorings.line_id', '=', 'lines.id')
			        ->leftJoin('machines', 'monitorings.machine_id', '=', 'machines.id')
			        ->leftJoin('users as uqi', 'uqi.id', '=', 'monitorings.qc_inspector')
			        ->leftJoin('users as qcb', 'qcb.id', '=', 'monitorings.qc_checked_by')
			        ->leftJoin('product_lines as pl', 'pl.id', '=', 'monitorings.product_line_id')
		            ->where('monitorings.id', $id)
		            ->where('monitorings.status', 1)
		            ->where('monitorings.logdel', 0)
		            ->first();

		$sampling_no_prod_count = Sampling::where("no_production_date", date("Y-m-d"))
					->where("no_production_date", $monitoring_info->id)
					->where('status', 1)
					->where('logdel', 0)
					->count();

		if($monitoring_info != null){
    		return view('view_monitoring_v2')->with(['id' => $id, 'monitoring_info' => $monitoring_info, 'sampling_no_prod_count' => $sampling_no_prod_count]);
		}
		else{
			return "Monitoring is not available.";
		}
    }
    else{
        return redirect()->route('session_expired');
    }
});

//CLARK
// STRATEGIC PO CONTROLLER
Route::get('/view_strategic_po', 'StrategicPoController@viewStrategicPo')->name('view_strategic_po');
Route::post('/save_strategic_po', 'StrategicPoController@saveStrategicPo')->name('save_strategic_po');
Route::post('/strategic_action', 'StrategicPoController@strategicAction')->name('strategic_action');
Route::get('/get_strategic_po_by_id', 'StrategicPoController@getStrategicPoById')->name('get_strategic_po_by_id');
Route::get('/get_series_name_by_stat', 'StrategicPoController@getSeriesNameByStat')->name('get_series_name_by_stat');
// Route::get('/get_cbo_series_by_stat', 'StrategicPoController@get_cbo_series_by_stat')->name('get_cbo_series_by_stat');

// USER CONTROLLER
Route::get('/view_users', 'UserController@view_users')->name('view_users');
Route::post('/save_user', 'UserController@save_user')->name('save_user');
Route::post('/user_action', 'UserController@user_action')->name('user_action');
Route::get('/get_user_by_id', 'UserController@get_user_by_id')->name('get_user_by_id');
Route::get('/get_user_by_stat', 'UserController@get_user_by_stat')->name('get_user_by_stat');
Route::get('/get_cbo_user_by_stat', 'UserController@get_cbo_user_by_stat')->name('get_cbo_user_by_stat');
Route::get('/get_system_one_emp_info', 'UserController@SystemOneEmpInfo')->name('get_system_one_emp_info'); //CLARK

// PRODUCT LINE CONTROLLER
Route::get('/view_product_lines', 'ProductLineController@view_product_lines')->name('view_product_lines');
Route::post('/save_product_line', 'ProductLineController@save_product_line')->name('save_product_line');
Route::post('/product_line_action', 'ProductLineController@product_line_action')->name('product_line_action');
Route::get('/get_product_line_by_id', 'ProductLineController@get_product_line_by_id')->name('get_product_line_by_id');
Route::get('/get_product_line_by_stat', 'ProductLineController@get_product_line_by_stat')->name('get_product_line_by_stat');
Route::get('/get_cbo_product_line_by_stat', 'ProductLineController@get_cbo_product_line_by_stat')->name('get_cbo_product_line_by_stat');
Route::get('/get_cbo_product_line_by_family', 'ProductLineController@get_cbo_product_line_by_family')->name('get_cbo_product_line_by_family');

// LINE
Route::get('/view_lines', 'LineController@view_lines')->name('view_lines');
Route::post('/save_line', 'LineController@save_line')->name('save_line');
Route::post('/line_action', 'LineController@line_action')->name('line_action');
Route::get('/get_line_by_id', 'LineController@get_line_by_id')->name('get_line_by_id');
Route::get('/get_line_by_stat', 'LineController@get_line_by_stat')->name('get_line_by_stat');
Route::get('/get_cbo_line_by_stat', 'LineController@get_cbo_line_by_stat')->name('get_cbo_line_by_stat');
Route::get('/get_cbo_line_by_product_line', 'LineController@get_cbo_line_by_product_line')->name('get_cbo_line_by_product_line');

// STATION
Route::get('/view_stations', 'StationController@view_stations')->name('view_stations');
Route::post('/save_station', 'StationController@save_station')->name('save_station');
Route::post('/station_action', 'StationController@station_action')->name('station_action');
Route::get('/get_station_by_id', 'StationController@get_station_by_id')->name('get_station_by_id');
Route::get('/get_station_by_stat', 'StationController@get_station_by_stat')->name('get_station_by_stat');
Route::get('/get_cbo_station_by_stat', 'StationController@get_cbo_station_by_stat')->name('get_cbo_station_by_stat');

// REFERENCE TYPE CONTROLLER
Route::get('/view_reference_types', 'ReferenceTypeController@view_reference_types')->name('view_reference_types');
Route::post('/save_reference_type', 'ReferenceTypeController@save_reference_type')->name('save_reference_type');
Route::post('/reference_type_action', 'ReferenceTypeController@reference_type_action')->name('reference_type_action');
Route::get('/get_reference_type_by_id', 'ReferenceTypeController@get_reference_type_by_id')->name('get_reference_type_by_id');
Route::get('/get_reference_type_by_stat', 'ReferenceTypeController@get_reference_type_by_stat')->name('get_reference_type_by_stat');
Route::get('/get_cbo_reference_type_by_stat', 'ReferenceTypeController@get_cbo_reference_type_by_stat')->name('get_cbo_reference_type_by_stat');

// SERIES CONTROLLER
Route::get('/view_serieses', 'SeriesController@view_serieses')->name('view_serieses');
Route::post('/save_series', 'SeriesController@save_series')->name('save_series');
Route::post('/series_action', 'SeriesController@series_action')->name('series_action');
Route::get('/get_series_by_id', 'SeriesController@get_series_by_id')->name('get_series_by_id');
Route::get('/get_series_by_stat', 'SeriesController@get_series_by_stat')->name('get_series_by_stat');
Route::get('/get_cbo_series_by_stat', 'SeriesController@get_cbo_series_by_stat')->name('get_cbo_series_by_stat');

// MACHINE CONTROLLER
Route::get('/view_machines', 'MachineController@view_machines')->name('view_machines');
Route::post('/save_machine', 'MachineController@save_machine')->name('save_machine');
Route::post('/machine_action', 'MachineController@machine_action')->name('machine_action');
Route::get('/get_machine_by_id', 'MachineController@get_machine_by_id')->name('get_machine_by_id');
Route::get('/get_machine_by_stat', 'MachineController@get_machine_by_stat')->name('get_machine_by_stat');
Route::get('/get_cbo_machine_by_stat', 'MachineController@get_cbo_machine_by_stat')->name('get_cbo_machine_by_stat');

// MONITORING CONTROLLER
Route::get('/view_monitorings', 'MonitoringController@view_monitorings')->name('view_monitorings');
Route::post('/save_monitoring', 'MonitoringController@save_monitoring')->name('save_monitoring');
Route::post('/monitoring_action', 'MonitoringController@monitoring_action')->name('monitoring_action');
Route::get('/get_monitoring_by_id', 'MonitoringController@get_monitoring_by_id')->name('get_monitoring_by_id');
Route::get('/get_monitoring_by_stat', 'MonitoringController@get_monitoring_by_stat')->name('get_monitoring_by_stat');
Route::get('/get_cbo_monitoring_by_stat', 'MonitoringController@get_cbo_monitoring_by_stat')->name('get_cbo_monitoring_by_stat');
Route::get('/load_monitoring', 'MonitoringController@load_monitoring')->name('load_monitoring');
// Route::post('/save_dla', 'MonitoringController@save_dla')->name('save_dla');
// Route::post('/save_dla_check_items', 'MonitoringController@save_dla_check_items')->name('save_dla_check_items');
Route::post('/save_unchecked_dla_check_items', 'MonitoringController@save_unchecked_dla_check_items')->name('save_unchecked_dla_check_items');
Route::post('/save_first_arr_dla_check_items', 'MonitoringController@save_first_arr_dla_check_items')->name('save_first_arr_dla_check_items');
Route::post('/save_second_arr_dla_check_items', 'MonitoringController@save_second_arr_dla_check_items')->name('save_second_arr_dla_check_items');
Route::post('/save_dla_results', 'MonitoringController@save_dla_results')->name('save_dla_results');
Route::get('/get_dla_check_items_by_monitoring_id', 'MonitoringController@get_dla_check_items_by_monitoring_id')->name('get_dla_check_items_by_monitoring_id');
Route::get('/get_dla_results_by_monitoring_id', 'MonitoringController@get_dla_results_by_monitoring_id')->name('get_dla_results_by_monitoring_id');

// SAMPLING CONTROLLER
Route::get('/view_samplings_pending', 'SamplingController@view_samplings')->name('view_samplings_pending');
Route::get('/view_samplings_ok', 'SamplingController@view_samplings')->name('view_samplings_ok');
Route::get('/view_samplings_ng', 'SamplingController@view_samplings')->name('view_samplings_ng');
Route::get('/view_samplings_no_prod_no_monitoring', 'SamplingController@view_samplings')->name('view_samplings_no_prod_no_monitoring');
Route::post('/save_multiple_sampling_result', 'SamplingController@saveMultipleSamplingResult')->name('save_multiple_sampling_result');
Route::post('/save_sampling', 'SamplingController@save_sampling')->name('save_sampling');
Route::post('/add_no_production', 'SamplingController@add_no_production')->name('add_no_production');
Route::post('/sampling_action', 'SamplingController@sampling_action')->name('sampling_action');
Route::get('/get_sampling_by_id', 'SamplingController@get_sampling_by_id')->name('get_sampling_by_id');
Route::get('/get_sampling_by_stat', 'SamplingController@get_sampling_by_stat')->name('get_sampling_by_stat');
Route::get('/get_cbo_sampling_by_stat', 'SamplingController@get_cbo_sampling_by_stat')->name('get_cbo_sampling_by_stat');
Route::get('/get_po_details', 'SamplingController@get_po_details')->name('get_po_details');
Route::get('/get_operator_details', 'SamplingController@get_operator_details')->name('get_operator_details');
Route::get('/get_strat_po_details', 'SamplingController@getStratPoDetails')->name('get_strat_po_details');

