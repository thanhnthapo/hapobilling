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

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'DashboardController@index')->name('backend.dashboard.index');
    Route::resource('user', 'UserController');
    Route::resource('project', 'ProjectController');
    Route::resource('customer', 'CustomerController');
    Route::resource('assign', 'AssignController');
});

Route::post('login', 'Admin\LoginController@postlogin');
Route::get('login', 'Admin\LogInController@getLogin')->name('login');
Route::get('logout','Admin\LogInController@getLogout')->name('logout');
