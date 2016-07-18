<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * PUBLIC APP
 */

Route::auth();
Route::get('/', ['as'=>'Inicio','uses'=>'HomeController@index']);
Route::get('logout','HomeController@logout');

//ADMINISTRATION
Route::get('/admin', ['as'=>'Administración','uses'=>'Admin\DashboardController@index']);

//ADMINISTRATION > GENERAL > USERS
Route::get('/admin/users', ['as'=>'Usuarios','uses'=>'Admin\UsersController@mainUsers']);
Route::get('/admin/users/add', ['as'=>'Agregar','uses'=>'Admin\UsersController@addUser']);
Route::get('/admin/users/update/{uuid}',['as'=>'Editar','uses'=>'Admin\UsersController@editUser']);
Route::get('/admin/users/remove/{uuid}', ['as'=>'Eliminar','uses'=>'Admin\UsersController@removeUser']);

Route::post('/admin/users/add', ['as'=>'createUser', 'uses'=>'Admin\UsersController@createUser']);
Route::post('/admin/users/update/',['as'=>'Editar','uses'=>'Admin\UsersController@updateUser']);

//ADMINISTRATION > GENERAL > GRADES
Route::get('/admin/grades', ['as'=>'Grados','uses'=>'Admin\GradesController@index']);
Route::get('/admin/grades/add', ['as'=>'Agregar','uses'=>'Admin\GradesController@addGrade']);
Route::get('/admin/grades/remove/{uuid}', ['as'=>'Eliminar','uses'=>'Admin\GradesController@remove']);
Route::get('/admin/grades/update/{uuid}', ['as'=>'Editar','uses'=>'Admin\GradesController@edit']);
Route::get('/admin/grades/{uuid}/courses', ['as'=>'Materias','uses'=>'Admin\GradesController@courses']);

Route::post('/admin/grades/add', ['as'=>'Agregar','uses'=>'Admin\GradesController@create']);
Route::post('/admin/grades/update', ['as'=>'Editar','uses'=>'Admin\GradesController@update']);

// ADMINISTRATION > GENERAL > COURSES
Route::get('/admin/courses',['as'=>'Materias', 'uses'=>'Admin\CoursesController@index']);
Route::get('/admin/courses/add',['as'=>'Agregar', 'uses'=>'Admin\CoursesController@add']);
Route::get('/admin/courses/remove/{uuid}', ['as'=>'Eliminar','uses'=>'Admin\CoursesController@remove']);
Route::get('/admin/courses/update/{uuid}', ['as'=>'Editar','uses'=>'Admin\CoursesController@edit']);

Route::post('/admin/courses/add', ['as'=>'Agregar', 'uses'=>'Admin\CoursesController@create']);
Route::post('/admin/courses/update', ['as'=>'Editar', 'uses'=>'Admin\CoursesController@update']);

//ADMINISTRATION > LOG
Route::get('/admin/systemlog', ['as'=>'Log','uses'=>'Admin\SystemController@log']);
Route::get('/admin/systemlog/{id}', ['as'=>'Descripción','uses'=>'Admin\SystemController@LogDescription']);