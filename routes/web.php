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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'IndexController@create');
// 后台

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
// 启用或停用
Route::patch('/user/{user}/editstatus', 'UserController@editstatus')->name('user.editstatus');
// 重置密码
Route::patch('/user/{user}/resetpwd', 'UserController@resetpwd')->name('user.resetpwd');
Route::get('/user/test', 'UserController@test')->name('user.test');


// 前台

Route::get('/index/login', 'IndexController@create')->name('index.login');
Route::post('/index/login', 'IndexController@store')->name('index.login');
Route::get('/index/logout', 'IndexController@logout')->name('index.logout');
Route::post('/index/changePwd', 'IndexController@changePwd')->name('index.changePwd');


Route::get('/objective/iamexecutor/{p1}', 'ObjectiveController@iamexecutor')->name('objective.iamexecutor');
Route::get('/objective/heisexecutor/{p1}', 'ObjectiveController@heisexecutor')->name('objective.heisexecutor');


Route::get('/objective/mine/', 'ObjectiveController@mine')->name('objective.mine');
Route::get('/objective/others/', 'ObjectiveController@others')->name('objective.others');

Route::get('/objectivelog/', 'ObjectiveController@mineObjectivelog')->name('objective.mineObjectivelog');
Route::get('/stateindexlog/', 'StateindexController@stateindexlog')->name('stateindex.stateindexlog');
Route::get('/missionlog/', 'MissionController@missionlog')->name('mission.missionlog');
Route::get('/planlog/', 'PlanController@planlog')->name('plan.planlog');


// 信心指数编辑
// Route::post('/confidentindex', 'ConfidentindexController@store')->name('confidentindex.store');


// 新增
Route::post('/objective', 'ObjectiveController@store')->name('objective.store');
Route::post('/keyresult', 'KeyresultController@store')->name('keyresult.store');
Route::post('/keyresult/updateConfidentindex/', 'KeyresultController@updateConfidentindex')->name('keyresult.updateConfidentindex');

Route::post('/plan', 'PlanController@store')->name('plan.store');

Route::post('/mission', 'MissionController@store')->name('mission.store');
Route::post('/stateindex', 'StateindexController@store')->name('stateindex.store');


// 评分
// Route::patch('/objective/{objective}/score', 'ObjectiveController@score')->name('objective.score');
// Route::patch('/keyresult/{keyresult}/score', 'KeyresultController@score')->name('keyresult.score');
// Route::patch('/plan/{plan}/score', 'PlanController@score')->name('plan.score');
Route::post('/objective/score', 'ObjectiveController@score')->name('objective.score');
Route::post('/keyresult/score', 'KeyresultController@score')->name('keyresult.score');
// Route::post('/plan/score', 'PlanController@score')->name('plan.score');

// 详细
Route::get('/objective/detail', 'ObjectiveController@detail')->name('objective.detail');
Route::get('/keyresult/detail', 'KeyresultController@detail')->name('keyresult.detail');
Route::get('/plan/detail', 'PlanController@detail')->name('plan.detail');

Route::get('/mission/detail', 'MissionController@detail')->name('mission.detail');
Route::get('/stateindex/detail', 'StateindexController@detail')->name('stateindex.detail');


// 更新
Route::post('/objective/update', 'ObjectiveController@update')->name('objective.update');
Route::post('/keyresult/update', 'KeyresultController@update')->name('keyresult.update');
Route::post('/plan/update', 'PlanController@update')->name('plan.update');

Route::post('/mission/update', 'MissionController@update')->name('mission.update');
Route::post('/stateindex/update', 'StateindexController@update')->name('stateindex.update');

// 删除
Route::get('/objective/delete', 'ObjectiveController@delete')->name('objective.delete');
Route::get('/keyresult/delete', 'KeyresultController@delete')->name('keyresult.delete');
Route::get('/plan/delete', 'PlanController@delete')->name('plan.delete');

Route::get('/mission/delete', 'MissionController@delete')->name('mission.delete');
Route::get('/stateindex/delete', 'StateindexController@delete')->name('stateindex.delete');



Route::post('/comment', 'CommentController@store')->name('comment.store');
Route::get('/comment', 'CommentController@index')->name('comment.index');

// Route::resource('users', 'UsersController');
// 相当于
// Route::get('/users', 'UsersController@index')->name('users.index');
// Route::get('/users/{user}', 'UsersController@show')->name('users.show');
// Route::get('/users/create', 'UsersController@create')->name('users.create');
// Route::post('/users', 'UsersController@store')->name('users.store');
// Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
// Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
// Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');