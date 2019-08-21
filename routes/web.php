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
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth', 'isAdmin'], function () {
    Route::get('/', 'DashboardController@index')->name('backend.dashboard.index');
    Route::resource('user', 'UserController')->middleware('checkPermission:User');
    Route::resource('project', 'ProjectController')->middleware('checkPermission:Project');
    Route::resource('customer', 'CustomerController')->middleware('checkPermission:Customer');
    Route::resource('assign', 'AssignController');
    Route::resource('department', 'DepartmentController')->middleware('checkPermission:Department');
    Route::resource('role', 'RoleController')->middleware('checkPermission:Role');
});

