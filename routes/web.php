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

// Route::get('/admin/login', 'AdminController@login')->name('admin.login');
Route::get('/admin/login', 'AdminController@create')->name('admin.login');
Route::post('/admin/login', 'AdminController@store')->name('admin.login');
Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');


// Route::get('/department', 'DepartmentController@list');
Route::get('/department', 'DepartmentController@index')->name('department.index');
Route::post('/department', 'DepartmentController@store')->name('department.store');
Route::delete('/department/{department}', 'DepartmentController@destroy')->name('department.destroy');
Route::get('/department/{department}/edit', 'DepartmentController@edit')->name('department.edit');
Route::patch('/department/{department}', 'DepartmentController@update')->name('department.update');


// Route::get('/user', 'UserController@list');
Route::get('/user', 'UserController@index')->name('user.index');
Route::post('/user', 'UserController@store')->name('user.store');
Route::delete('/user/{department}', 'UserController@destroy')->name('user.destroy');
Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
Route::patch('/user/{user}', 'UserController@update')->name('user.update');
Route::patch('/user/{user}/editstatus', 'UserController@editstatus')->name('user.editstatus');
Route::patch('/user/{user}/resetpwd', 'UserController@resetpwd')->name('user.resetpwd');
Route::get('/user/test', 'UserController@test')->name('user.test');





// Route::resource('users', 'UsersController');
// 相当于
// Route::get('/users', 'UsersController@index')->name('users.index');
// Route::get('/users/{user}', 'UsersController@show')->name('users.show');
// Route::get('/users/create', 'UsersController@create')->name('users.create');
// Route::post('/users', 'UsersController@store')->name('users.store');
// Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
// Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
// Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');