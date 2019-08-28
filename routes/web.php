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

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name('backend.dashboard.index');

    Route::resource('user', 'UserController')->middleware('checkPermission:User');
    Route::post('user/delete', 'UserController@DeleteAjax')->middleware('checkPermission:User');

    Route::resource('project', 'ProjectController')->middleware('checkPermission:Project');
    Route::post('project/delete', 'ProjectController@DeleteAjax')->middleware('checkPermission:Project');
    Route::post('project/ajax-task', 'ProjectController@AjaxTask');

    Route::resource('task', 'TaskController')->middleware('checkPermission:Project');
    Route::post('task/delete', 'TaskController@deleteAjax');
    Route::post('task/deleteUserTask','TaskController@DeleteUserAjax');

    Route::resource('customer', 'CustomerController')->middleware('checkPermission:Customer');
    Route::post('customer/delete', 'CustomerController@DeleteAjax')->middleware('checkPermission:Customer');

    Route::resource('assign', 'AssignController');
    Route::post('assign/delete', 'AssignController@DeleteAjax');

    Route::resource('department', 'DepartmentController')->middleware('checkPermission:Department');
    Route::post('department/delete', 'DepartmentController@DeleteAjax')->middleware('checkPermission:Department');

    Route::resource('role', 'RoleController')->middleware('checkPermission:Role');

    Route::resource('permission', 'PermissionController')->middleware('checkPermission:Permission');
});

