<?php


// ADMIN - USERS

Breadcrumbs::register('Administración', function($breadcrumbs) {
    $breadcrumbs->push('Administración', action('Admin\DashboardController@index'));
});

Breadcrumbs::register('Usuarios', function($breadcrumbs) {
    $breadcrumbs->parent('Administración');
    $breadcrumbs->push('Usuarios', action('Admin\UsersController@mainUsers'));
});

Breadcrumbs::register('Agregar', function($breadcrumbs) {
    $breadcrumbs->parent('Usuarios');
    $breadcrumbs->push('Agregar', action('Admin\UsersController@addUser'));
});

Breadcrumbs::register('createUser', function($breadcrumbs) {
    $breadcrumbs->parent('Agregar');
    $breadcrumbs->push('createUser', action('Admin\UsersController@addUser'));
});

Breadcrumbs::register('Editar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Usuarios');
    $breadcrumbs->push('Editar', action('Admin\UsersController@editUser',$uuid));
});

Breadcrumbs::register('Eliminar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Usuarios');
    $breadcrumbs->push('Eliminar', action('Admin\UsersController@removeUser',$uuid));
});

// ADMIN - GRADES

Breadcrumbs::register('Grados', function($breadcrumbs) {
    $breadcrumbs->parent('Administración');
    $breadcrumbs->push('Grados', action('Admin\GradesController@index'));
});

Breadcrumbs::register('Agregar', function($breadcrumbs) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Agregar', action('Admin\GradesController@addGrade'));
});

Breadcrumbs::register('Eliminar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Eliminar', action('Admin\GradesController@remove',$uuid));
});

Breadcrumbs::register('Editar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Editar', action('Admin\GradesController@edit',$uuid));
});

Breadcrumbs::register('Editar', function($breadcrumbs) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Editar', action('Admin\GradesController@update'));
});

Breadcrumbs::register('Materias', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Materias', action('Admin\GradesController@courses', $uuid));
});

// ADMIN COURSES

Breadcrumbs::register('Materias', function ($breadcrumbs) {
    $breadcrumbs->parent('Administración');
    $breadcrumbs->push('Materias', action('Admin\CoursesController@index'));
});

Breadcrumbs::register('Agregar', function($breadcrumbs) {
    $breadcrumbs->parent('Materias');
    $breadcrumbs->push('Agregar', action('Admin\CoursesController@add'));
});

Breadcrumbs::register('Eliminar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Materias');
    $breadcrumbs->push('Eliminar', action('Admin\CoursesController@remove', $uuid));
});

Breadcrumbs::register('Editar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Materias');
    $breadcrumbs->push('Editar', action('Admin\CoursesController@edit', $uuid));
});

Breadcrumbs::register('Editar', function($breadcrumbs) {
    $breadcrumbs->parent('Materias');
    $breadcrumbs->push('Editar', action('Admin\CoursesController@update'));
});

// ADMIN UNITS

Breadcrumbs::register('Unidades', function ($breadcrumbs) {
    $breadcrumbs->parent('Administración');
    $breadcrumbs->push('Materias', action('Admin\UnitController@index'));
});

Breadcrumbs::register('Agregar', function($breadcrumbs) {
    $breadcrumbs->parent('Unidades');
    $breadcrumbs->push('Agregar', action('Admin\UnitController@add'));
});

Breadcrumbs::register('Eliminar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Unidades');
    $breadcrumbs->push('Eliminar', action('Admin\UnitController@remove', $uuid));
});

Breadcrumbs::register('Editar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Unidades');
    $breadcrumbs->push('Editar', action('Admin\UnitController@edit', $uuid));
});

Breadcrumbs::register('Editar', function($breadcrumbs) {
    $breadcrumbs->parent('Unidades');
    $breadcrumbs->push('Editar', action('Admin\UnitController@update'));
});


// ADMIN EVENTS

Breadcrumbs::register('Eventos', function ($breadcrumbs) {
    $breadcrumbs->parent('Administración');
    $breadcrumbs->push('Materias', action('Admin\UnitController@index'));
});

Breadcrumbs::register('Agregar', function($breadcrumbs) {
    $breadcrumbs->parent('Materias');
    $breadcrumbs->push('Agregar', action('Admin\UnitController@add'));
});

Breadcrumbs::register('Eliminar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Materias');
    $breadcrumbs->push('Eliminar', action('Admin\UnitController@remove', $uuid));
});

Breadcrumbs::register('Editar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Materias');
    $breadcrumbs->push('Editar', action('Admin\UnitController@edit', $uuid));
});

Breadcrumbs::register('Editar', function($breadcrumbs) {
    $breadcrumbs->parent('Materias');
    $breadcrumbs->push('Editar', action('Admin\UnitController@update'));
});





// ADMIN LOG


Breadcrumbs::register('Log', function($breadcrumbs) {
    $breadcrumbs->parent('Administración');
    $breadcrumbs->push('Log', action('Admin\SystemController@log'));
});

Breadcrumbs::register('Descripción', function($breadcrumbs,$id) {
    $breadcrumbs->parent('Log');
    $breadcrumbs->push('Descripción', action('Admin\SystemController@LogDescription',$id));
});