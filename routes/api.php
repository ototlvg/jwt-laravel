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

Route::post('/login', 'Api\Auth\LoginController@login');
Route::get('/getuser', 'Api\Auth\LoginController@getuser')->middleware('checkCookie');
Route::get('/getpayload', 'Api\Auth\LoginController@getPayload')->middleware('checkCookie');
//Route::get('/getuser', 'Api\Auth\LoginController@getuser')->middleware('checkAuth');
Route::post('/check-cookie', 'Api\Auth\LoginController@checkCookie')->middleware('checkCookie');
Route::post('/check', 'Api\Auth\LoginController@check')->middleware('checkCookie');

