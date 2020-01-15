<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('dashboard')->name('dashboard.')->group(function(){
    Route::get('/index', 'DashboardController@index')->name('index');
    Route::resource('/employee', 'EmployeeController');
    Route::resource('/schedule', 'ScheduleController');
    Route::get('/attendance', 'AttendanceController@index');
    Route::get('/hours', 'AttendanceController@totalhour')->name('hours');

});



Route::get('/sign', function (){
    return view('dashboard.attendance.signin');

});
Route::post('sign', 'AttendanceController@sign' )->name('sign');
Route::get('/log', function (){
    return view('dashboard.attendance.log');

});
Route::post('log', 'CheckoutController@log' )->name('log');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
