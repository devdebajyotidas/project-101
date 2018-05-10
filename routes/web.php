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

    Route::get('settings', 'SettingsController@home');

    Route::get('users', 'EmployeeController@index');

    Route::get('takers', 'CustomerController@index');

    Route::get('providers', 'CustomerController@index');

    Route::get('services', 'ServiceController@index');

    Route::get('reports', 'ReportController@index');

    Route::get('analytics', 'AnalyticController@index');
});