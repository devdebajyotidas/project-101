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

Route::group(['namespace' => 'Web'], function () {

    Auth::routes();
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('home', 'HomeController@home');
    Route::get('profile', 'HomeController@profile');
    Route::get('settings', 'HomeController@settings');
    Route::get('services', 'ServiceController@index');
    Route::post('services/load/result', 'ServiceController@load');
    Route::post('service/new','ServiceController@create');
    Route::post('services/{service_id}/archive', 'ServiceController@archive');
    Route::get('providers', 'ProviderController@index');
    Route::get('providers/{account_id}', 'ProviderController@show');
    Route::post('providers/load/result', 'ProviderController@search');
    Route::get('providers/profile/{account_id}', 'ProviderController@profile');
    Route::get('customer', 'CustomerController@index');
    Route::get('customer/{account_id}', 'CustomerController@show');
    Route::post('customer/load/result', 'CustomerController@search');
    Route::get('shouts', 'ShoutController@index');
    Route::post('shouts/load/result', 'ShoutController@load');
    Route::get('payments', 'PaymentController@index');
    Route::get('feedback', 'FeedbackController@index');
    Route::get('reports', 'ReportsController@index');

});