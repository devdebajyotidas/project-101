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

    Route::get('home', 'HomeController@home')->middleWare('checkAuth');
    Route::post('home/map/load', 'HomeController@load')->middleWare('checkAuth');
    Route::post('home/account/info/{account_id}', 'HomeController@accountInfo')->middleWare('checkAuth');
    Route::get('profile', 'HomeController@profile')->middleWare('checkAuth');
    Route::get('home/map/locate' ,'HomeController@locate')->middleWare('checkAuth');

    Route::get('employees', 'EmployeeController@index')->middleWare('checkAuth');
    Route::post('employees/load/result', 'EmployeeController@load')->middleWare('checkAuth');
    Route::post('employees/invite', 'EmployeeController@invite')->middleWare('checkAuth');
    Route::post('employees/update', 'EmployeeController@update')->middleWare('checkAuth');
    Route::get('employees/invitation/{token}', 'EmployeeController@show')->middleWare('checkAuth');
    Route::post('employees/invitation/{token}', 'EmployeeController@update')->middleWare('checkAuth');
    Route::get('employees/profile/{account_id}', 'EmployeeController@profile')->middleWare('checkAuth');

    Route::get('settings', 'HomeController@settings')->middleWare('checkAuth');
    Route::get('services', 'ServiceController@index')->middleWare('checkAuth');
    Route::post('services/load/result', 'ServiceController@load')->middleWare('checkAuth');
    Route::post('service/new','ServiceController@create')->middleWare('checkAuth');
    Route::post('services/{service_id}/archive', 'ServiceController@archive')->middleWare('checkAuth');
    Route::get('providers', 'ProviderController@index')->middleWare('checkAuth');
    Route::get('providers/{account_id}', 'ProviderController@show')->middleWare('checkAuth');
    Route::post('providers/load/result', 'ProviderController@search')->middleWare('checkAuth');
    Route::get('providers/profile/{account_id}', 'ProviderController@profile')->middleWare('checkAuth');
    Route::get('customer', 'CustomerController@index')->middleWare('checkAuth');
    Route::get('customer/profile/{account_id}', 'CustomerController@profile')->middleWare('checkAuth');
    Route::post('customer/load/result', 'CustomerController@search')->middleWare('checkAuth');
    Route::post('customer/{account_id}/block', 'CustomerController@block')->middleWare('checkAuth');
    Route::get('shouts', 'ShoutController@index')->middleWare('checkAuth');
    Route::post('shouts/load/result', 'ShoutController@load')->middleWare('checkAuth');
    Route::get('payments', 'PaymentController@index')->middleWare('checkAuth');
    Route::get('feedback', 'FeedbackController@index')->middleWare('checkAuth');
    Route::post('feedback/load/result', 'FeedbackController@load')->middleWare('checkAuth');
    Route::post('feedback/user/result', 'FeedbackController@load')->middleWare('checkAuth');
    Route::get('reports', 'ReportsController@index')->middleWare('checkAuth');
    Route::post('reports/load/service', 'ReportsController@serviceHistory')->middleWare('checkAuth');
    Route::post('reports/load/customer', 'ReportsController@customerHistory')->middleWare('checkAuth');
    Route::post('reports/load/vendor', 'ReportsController@vendorHistory')->middleWare('checkAuth');
    Route::get('reports/service/{service_id}', 'ReportsController@serviceReport')->middleWare('checkAuth');
    Route::post('reports/load/service/usage/{service_id}', 'ReportsController@serviceUsage')->middleWare('checkAuth');
    Route::post('reports/load/service/taken/{service_id}', 'ReportsController@serviceTaken')->middleWare('checkAuth');

    Route::get('services/request', 'RequestController@index')->middleWare('checkAuth');

    Route::get('settings', 'SettingsController@index')->middleWare('checkAuth');

});