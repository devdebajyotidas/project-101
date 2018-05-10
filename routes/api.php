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
    Route::post('accounts/login', 'UserController@checkOtp');
    Route::post('accounts/otp/request', 'UserController@requestOtp');
    Route::get('accounts/otp/resend/{request_id}', 'UserController@resendOtp');
    Route::post('accounts/login/advanced', 'UserController@login');
    Route::post('accounts/register', 'UserController@register');
    Route::post('accounts/{id}', 'UserController@resetPassword');
    Route::put('accounts/{id}', 'UserController@update');
    Route::delete('accounts/{id}', 'UserController@delete');

    /*Services*/
    Route::post('services/{id}', 'ServiceController@store');//service provider id
    Route::get('services/{id}', 'ServiceController@index'); //service provider id
    Route::get('services/show/{userId}/{serviceId}', 'ServiceController@show');//service id
    Route::put('services/{id}', 'ServiceController@update');//service id
    Route::delete('services/{id}', 'ServiceController@delete');//service id
    Route::post('services/search/{user_id}', 'ServiceController@search');


    /*Comments & Ratings*/
    Route::get('comment/{provider_id}', 'CommentController@index');
    Route::post('comment', 'CommentController@store');
    Route::put('comment/{comment_id}', 'CommentController@update');


});