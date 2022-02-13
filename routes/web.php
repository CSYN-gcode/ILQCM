<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/link', function () {
    return 'link';
})->name('link');


Route::get('/', function () {
    return view('index');
})->name('login');

Route::get('/session_expired', function () {
    return view('session_expired');
})->name('session_expired');

// Route::get('/login', function () {
//     return view('index');
// })->name('login');

// Route::get('/dashboard', function () {
//     return view('cso.dashboard');
// })->name('dashboard');

// ROUTE CONTROLLER
Route::get('/dashboard', 'RouteController@dashboard')->name('dashboard');
Route::get('/users', 'RouteController@users')->name('users');
Route::get('/lines', 'RouteController@lines')->name('lines');
Route::get('/stations', 'RouteController@stations')->name('stations');
Route::get('/monitoring', 'RouteController@monitoring')->name('monitoring');

// USER CONTROLLER
Route::post('/sign_in', 'UserController@sign_in')->name('sign_in');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('/view_users', 'UserController@view_users')->name('view_users');
Route::post('/save_user', 'UserController@save_user')->name('save_user');
Route::post('/user_action', 'UserController@user_action')->name('user_action');
Route::get('/get_user_by_id', 'UserController@get_user_by_id')->name('get_user_by_id');
Route::get('/view_existing_branch_users', 'UserController@view_existing_branch_users')->name('view_existing_branch_users');
Route::post('/add_user_branch', 'UserController@add_user_branch')->name('add_user_branch');
Route::post('/branch_user_action', 'UserController@branch_user_action')->name('branch_user_action');
Route::post('/change_password', 'UserController@change_password')->name('change_password');
Route::get('/view_branch_user_by_user_id', 'UserController@view_branch_user_by_user_id')->name('view_branch_user_by_user_id');
Route::post('/select_branch', 'UserController@select_branch')->name('select_branch');
Route::get('/count_users', 'UserController@count_users')->name('count_users');

// LINE
Route::get('/view_lines', 'LineController@view_lines')->name('view_lines');
Route::post('/save_line', 'LineController@save_line')->name('save_line');
Route::post('/line_action', 'LineController@line_action')->name('line_action');
Route::get('/get_line_by_id', 'LineController@get_line_by_id')->name('get_line_by_id');
Route::get('/get_line_by_stat', 'LineController@get_line_by_stat')->name('get_line_by_stat');
Route::get('/get_cbo_line_by_stat', 'LineController@get_cbo_line_by_stat')->name('get_cbo_line_by_stat');

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

