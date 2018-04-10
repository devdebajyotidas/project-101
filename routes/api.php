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

Route::group(['namespace' => 'API'], function () {

    /*Test Endpoints*/

    Route::get('ping', 'TestController@ping');
    Route::post('postapi', 'TestController@post_test');
    Route::get('aadhaar', 'TestController@testaadhaar');


    /*Accounts*/
    Route::post('accounts/login', 'UserController@login');
    Route::post('accounts/register', 'UserController@register');
    Route::post('accounts/{id}', 'UserController@resetPassword');
    Route::put('accounts/{id}', 'UserController@update');
    Route::delete('accounts/{id}', 'UserController@delete');

    /*Services*/
    Route::get('services/{id}', 'ServiceController@index'); //service provider id
    Route::get('services/find/{id}', 'ServiceController@show');//service id
    Route::post('services/{id}', 'ServiceController@store');//service provider id
    Route::put('services/{id}', 'ServiceController@update');//service id
    Route::delete('services/{id}', 'ServiceController@delete');//service id
    Route::get('services/location/{location}', 'ServiceController@serviceByLocation');//location
    Route::get('services/provider/{id}', 'ServiceController@serviceByProvider');//service provider id

});