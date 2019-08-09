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
Auth::routes();
Route::group(['namespace' => 'Admin', 'prefix' => 'admin',], function () {
    Route::get('/', 'DashboardController@index')->name('backend.dashboard.index')->middleware('auth');;
    Route::resource('user', 'UserController');
    Route::resource('project', 'ProjectController');
    Route::resource('customer', 'CustomerController');
    Route::resource('assign', 'AssignController');
});

