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


//ADMINISTRATION
Route::get('/admin', ['as'=>'Administración','uses'=>'adminController@dashboard']);

//GENERAL > USERS
Route::get('/admin/users', ['as'=>'Usuarios','uses'=>'Admin\UsersController@mainUsers']);
Route::get('/admin/users/add', ['as'=>'Agregar','uses'=>'Admin\UsersController@addUser']);
Route::get('/admin/users/update/{uuid}',['as'=>'Editar','uses'=>'Admin\UsersController@editUser']);
Route::get('/admin/users/remove/{uuid}', ['as'=>'Eliminar','uses'=>'Admin\UsersController@removeUser']);

Route::post('/admin/users/add', ['as'=>'createUser', 'uses'=>'Admin\UsersController@createUser']);
Route::post('/admin/users/update/',['as'=>'Editar','uses'=>'Admin\UsersController@updateUser']);

//GENERAL > GRADES
Route::get('/admin/grades', ['as'=>'Grados','uses'=>'Admin\GradesController@index']);
Route::get('/admin/grades/add', ['as'=>'Agregar','uses'=>'Admin\GradesController@addGrade']);
Route::get('/admin/grades/remove/{uuid}', ['as'=>'Eliminar','uses'=>'Admin\GradesController@remove']);

Route::post('/admin/grades/add', ['as'=>'Agregar','uses'=>'Admin\GradesController@create']);