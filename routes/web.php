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

//    Route::resource('user', 'UserController')->middleware('checkPermission:User');
    Route::get('user', 'UserController@index')->name('user.index');
    Route::get('user/create', 'UserController@create')->name('user.create')->middleware('checkPermission:User');
    Route::post('user', 'UserController@store')->name('user.store')->middleware('checkPermission:User');
    Route::get('user/{id}', 'UserController@show')->name('user.show');
    Route::get('user/{id}/edit', 'UserController@edit')->name('user.edit')->middleware('checkPermission:User');
    Route::post('user{id}', 'UserController@update')->name('user.update')->middleware('checkPermission:User');
    Route::post('user/delete', 'UserController@DeleteAjax')->middleware('checkPermission:User');
    Route::post('user/search', 'UserController@searchFull')->name('search');


    Route::get('project', 'ProjectController@index')->name('project.index');
    Route::get('project/create', 'ProjectController@create')->name('project.create')->middleware('checkPermission:Project');
    Route::post('project', 'ProjectController@store')->name('project.store')->middleware('checkPermission:Project');
    Route::get('project/{id}', 'ProjectController@show')->name('project.show');
    Route::get('project/{id}/edit', 'ProjectController@edit')->name('project.edit')->middleware('checkPermission:Project');
    Route::post('project{id}', 'ProjectController@update')->name('project.update')->middleware('checkPermission:Project');
    Route::post('project/delete', 'ProjectController@DeleteAjax')->middleware('checkPermission:Project');
    Route::post('project/delete', 'ProjectController@DeleteAjax')->middleware('checkPermission:Project');
    Route::post('project/ajax-task', 'ProjectController@AjaxTask')->middleware('checkPermission:Project');

    Route::resource('task', 'TaskController')->middleware('checkPermission:Project');
    Route::post('task/delete', 'TaskController@deleteAjax');
    Route::post('task/deleteUserTask','TaskController@DeleteUserAjax');

    Route::resource('customer', 'CustomerController')->middleware('checkPermission:Customer');
    Route::post('customer/delete', 'CustomerController@DeleteAjax')->middleware('checkPermission:Customer');

    Route::resource('assign', 'AssignController')->middleware('checkPermission:Project');
    Route::post('assign/delete', 'AssignController@DeleteAjax');

    Route::resource('department', 'DepartmentController')->middleware('checkPermission:Department');
    Route::post('department/delete', 'DepartmentController@DeleteAjax')->middleware('checkPermission:Department');

    Route::resource('role', 'RoleController')->middleware('checkPermission:Role');

    Route::resource('permission', 'PermissionController')->middleware('checkPermission:Permission');

    Route::resource('report', 'ReportController');
});

