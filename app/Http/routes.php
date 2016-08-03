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
Route::get('/admin/users', ['as'=>'Usuarios','uses'=>'Admin\UsersController@index']);
Route::get('/admin/users/add', ['as'=>'Agregar','uses'=>'Admin\UsersController@addUser']);
Route::get('/admin/users/update/{uuid}',['as'=>'Editar Usuarios','uses'=>'Admin\UsersController@editUser']);
Route::get('/admin/users/remove/{uuid}', ['as'=>'Eliminar','uses'=>'Admin\UsersController@removeUser']);

Route::post('/admin/users/add', ['as'=>'Agregar', 'uses'=>'Admin\UsersController@createUser']);
Route::post('/admin/users/update/',['as'=>'Editar Usuarios','uses'=>'Admin\UsersController@updateUser']);

//ADMINISTRATION > GENERAL > GRADES
Route::get('/admin/grades', ['as'=>'Grados','uses'=>'Admin\GradesController@index']);
Route::get('/admin/grades/add', ['as'=>'Agregar Grados','uses'=>'Admin\GradesController@addGrade']);
Route::get('/admin/grades/remove/{uuid}', ['as'=>'Eliminar Grados','uses'=>'Admin\GradesController@remove']);
Route::get('/admin/grades/update/{uuid}', ['as'=>'Editar Grados','uses'=>'Admin\GradesController@edit']);
Route::get('/admin/grades/{uuid}/courses', ['as'=>'Grados - Materias','uses'=>'Admin\GradesController@courses']);

Route::post('/admin/grades/add', ['as'=>'Agregar Grados','uses'=>'Admin\GradesController@create']);
Route::post('/admin/grades/update', ['as'=>'Editar Grados','uses'=>'Admin\GradesController@update']);
Route::post('/admin/grades/course/update', ['as'=>'Editar Grados','uses'=>'Admin\GradesController@courseUpdate']);

// ADMINISTRATION > GENERAL > COURSES
Route::get('/admin/courses',['as'=>'Materias', 'uses'=>'Admin\CoursesController@index']);
Route::get('/admin/courses/add',['as'=>'Agregar Materias', 'uses'=>'Admin\CoursesController@add']);
Route::get('/admin/courses/remove/{uuid}', ['as'=>'Eliminar Materias','uses'=>'Admin\CoursesController@remove']);
Route::get('/admin/courses/update/{uuid}', ['as'=>'Editar Materias','uses'=>'Admin\CoursesController@edit']);

Route::post('/admin/courses/add', ['as'=>'Agregar Materias', 'uses'=>'Admin\CoursesController@create']);
Route::post('/admin/courses/update', ['as'=>'Editar Materias', 'uses'=>'Admin\CoursesController@update']);

// ADMINISTRATION > GENERAL > UNITS
Route::get('/admin/units',['as'=>'Unidades', 'uses'=>'Admin\UnitController@index']);
Route::get('/admin/units/add',['as'=>'Agregar Unidad', 'uses'=>'Admin\UnitController@add']);
Route::get('/admin/units/remove/{uuid}', ['as'=>'Eliminar Unidad','uses'=>'Admin\UnitController@remove']);
Route::get('/admin/units/update/{uuid}', ['as'=>'Editar Unidad','uses'=>'Admin\UnitController@edit']);

Route::post('/admin/units/add', ['as'=>'Agregar Unidad', 'uses'=>'Admin\UnitController@create']);
Route::post('/admin/units/update', ['as'=>'Editar Unidad', 'uses'=>'Admin\UnitController@update']);

// ADMINISTRATION > GENERAL > EVENTS
Route::get('/admin/events',['as'=>'Events', 'uses'=>'Admin\EventsController@index']);
Route::get('/admin/events/add',['as'=>'Agregar Evento', 'uses'=>'Admin\EventsController@add']);
Route::get('/admin/events/remove/{uuid}', ['as'=>'Eliminar Evento','uses'=>'Admin\EventsController@remove']);
Route::get('/admin/events/update/{uuid}', ['as'=>'Editar Evento','uses'=>'Admin\EventsController@edit']);

Route::post('/admin/events/add', ['as'=>'Agregar Evento', 'uses'=>'Admin\EventsController@create']);
Route::post('/admin/events/update', ['as'=>'Editar Evento', 'uses'=>'Admin\EventsController@update']);

// ADMINISTRATION > GENERAL > HOMEWORKS
Route::get('/admin/homeworks',['as'=>'Tareas', 'uses'=>'Admin\HomeworksController@index']);
Route::get('/admin/homeworks/add',['as'=>'Agregar Tarea', 'uses'=>'Admin\HomeworksController@add']);
Route::post('/admin/homeworks/getadd',['as'=>'Obtener Tarea', 'uses'=>'Admin\HomeworksController@getAdd']);
Route::get('/admin/homeworks/remove/{uuid}', ['as'=>'Eliminar Tarea','uses'=>'Admin\HomeworksController@remove']);
Route::get('/admin/homeworks/update/{uuid}', ['as'=>'Editar Tarea','uses'=>'Admin\HomeworksController@edit']);

Route::post('/admin/homeworks/add', ['as'=>'Agregar Tarea', 'uses'=>'Admin\HomeworksController@create']);
Route::post('/admin/homeworks/update', ['as'=>'Editar Tarea', 'uses'=>'Admin\HomeworksController@update']);

// ADMINISTRATION > CONTENTS
Route::get('/admin/contents',['as'=>'Contenidos', 'uses'=>'Admin\ContentsController@index']);
Route::get('/admin/contents/add',['as'=>'Agregar Contenido', 'uses'=>'Admin\ContentsController@add']);
Route::get('/admin/contents/{uuid}/remove',['as'=>'Eliminar Contenido', 'uses'=>'Admin\ContentsController@remove']);
Route::get('/admin/contents/update/{uuid}',['as'=>'Editar Contenido', 'uses'=>'Admin\ContentsController@edit']);

Route::post('/admin/contents/create',['as'=>'Agregar Contenido', 'uses'=>'Admin\ContentsController@create']);
Route::post('/admin/contents/update',['as'=>'Editar Contenido', 'uses'=>'Admin\ContentsController@update']);

//ADMINISTRATION > LOG
Route::get('/admin/systemlog', ['as'=>'Log','uses'=>'Admin\SystemController@log']);
Route::get('/admin/systemlog/{id}', ['as'=>'Descripción','uses'=>'Admin\SystemController@LogDescription']);