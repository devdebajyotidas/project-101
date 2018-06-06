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
    Route::post('home/map/load', 'HomeController@load');
    Route::post('home/account/info/{account_id}', 'HomeController@accountInfo');
    Route::get('profile', 'HomeController@profile');

    Route::get('employees', 'EmployeeController@index');
    Route::post('employees/load/result', 'EmployeeController@load');
    Route::post('employees/invite', 'EmployeeController@invite');
    Route::post('employees/update', 'EmployeeController@update');
    Route::get('employees/invitation/{token}', 'EmployeeController@show');
    Route::post('employees/invitation/{token}', 'EmployeeController@update');
    Route::get('employees/profile/{account_id}', 'EmployeeController@profile');

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
    Route::get('customer/profile/{account_id}', 'CustomerController@profile');
    Route::post('customer/load/result', 'CustomerController@search');
    Route::post('customer/{account_id}/block', 'CustomerController@block');
    Route::get('shouts', 'ShoutController@index');
    Route::post('shouts/load/result', 'ShoutController@load');
    Route::get('payments', 'PaymentController@index');
    Route::get('feedback', 'FeedbackController@index');
    Route::post('feedback/load/result', 'FeedbackController@load');
    Route::post('feedback/user/result', 'FeedbackController@load');
    Route::get('reports', 'ReportsController@index');
    Route::post('reports/load/service', 'ReportsController@serviceHistory');
    Route::post('reports/load/customer', 'ReportsController@customerHistory');
    Route::post('reports/load/vendor', 'ReportsController@vendorHistory');
    Route::get('reports/service/{service_id}', 'ReportsController@serviceReport');
    Route::post('reports/load/service/usage/{service_id}', 'ReportsController@serviceUsage');
    Route::post('reports/load/service/taken/{service_id}', 'ReportsController@serviceTaken');
});