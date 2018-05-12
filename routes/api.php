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

    /*Authentication*/
    Route::post('accounts/login', 'UserController@checkOtp');
    Route::post('accounts/otp/request', 'UserController@requestOtp');
    Route::get('accounts/otp/resend/{request_id}', 'UserController@resendOtp');
    Route::post('accounts/login/advance', 'UserController@login');
    Route::post('accounts/register', 'UserController@register');

    /*Profile*/
    Route::get('profile/{account_id}', 'AccountContoller@index');
    Route::put('profile/{account_id}', 'AccountController@update');
    Route::delete('profile/{account_id}', 'AccountController@delete');
    Route::post('profile/{account_id}/change/password', 'AccountController@changePassword');
    Route::post('profile/{account_id}/change/mobile', 'AccountController@changeMobile');
    Route::post('profile/{account_id}/change/email', 'AccountController@changeEmail');
    Route::post('profile/{account_id}/verify/email', 'AccountController@verifyEmail');
    Route::post('profile/{account_id}/verify/aadhaar', 'AccountController@verifyAadhaar'); //incomplete

    /*Service Provider*/
    Route::get('service/{account_id}', 'ServiceController@index');
    Route::get('service/show/{service_id}', 'ServiceController@show');
    Route::post('service/{account_id}', 'ServiceController@store');
    Route::put('service/{service_id}', 'ServiceController@update');
    Route::delete('service/{service_id}', 'ServiceController@delete');
    Route::get('timeline/{account_id}', 'ServiceController@timeline');

    /*Service Taker*/
    Route::get('service/scatter', 'ServiceController@scatter');
    Route::post('service/location', 'ServiceController@byLocation'); //lat,longi post
    Route::post('service/search', 'ServiceController@search');
    Route::get('service/bubble/{user_id}/{service_id}', 'ServiceController@bubble');

    /*Comments & Ratings*/
    Route::get('comment/{account_id}', 'CommentController@index');
    Route::post('comment', 'CommentController@store');
    Route::put('comment/{comment_id}', 'CommentController@update');

    /*Main Page*/
    Route::post('services/load','ServiceController@load');


});