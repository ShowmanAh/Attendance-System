<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register','Api\AuthController@register');
Route::post('/sign' ,'Api\AuthController@sign');
Route::post('/checkin' ,'Api\AuthController@checkin');
Route::post('/log', 'Api\AuthController@log');
Route::get('/users', 'Api\AuthController@index');
