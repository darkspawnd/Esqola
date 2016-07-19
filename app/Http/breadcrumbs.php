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

Breadcrumbs::register('Agregar', function($breadcrumbs) {
    $breadcrumbs->parent('Usuarios');
    $breadcrumbs->push('Agregar', action('Admin\UsersController@addUser'));
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

Breadcrumbs::register('Agregar Grados', function($breadcrumbs) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Agregar Grados', action('Admin\GradesController@addGrade'));
});

Breadcrumbs::register('Eliminar Grados', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Eliminar Grados', action('Admin\GradesController@remove',$uuid));
});

Breadcrumbs::register('Editar Grados', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Editar Grados', action('Admin\GradesController@edit',$uuid));
});

Breadcrumbs::register('Editar Grados', function($breadcrumbs) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Editar Grados', action('Admin\GradesController@update'));
});

Breadcrumbs::register('Grados - Materias', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Grados - Materias', action('Admin\GradesController@courses', $uuid));
});

// ADMIN COURSES

Breadcrumbs::register('Materias', function ($breadcrumbs) {
    $breadcrumbs->parent('Administración');
    $breadcrumbs->push('Materias', action('Admin\CoursesController@index'));
});

Breadcrumbs::register('Agregar Materias', function($breadcrumbs) {
    $breadcrumbs->parent('Materias');
    $breadcrumbs->push('Agregar Materias', action('Admin\CoursesController@add'));
});

Breadcrumbs::register('Eliminar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Materias');
    $breadcrumbs->push('Eliminar Materias', action('Admin\CoursesController@remove', $uuid));
});

Breadcrumbs::register('Editar Materias', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Materias');
    $breadcrumbs->push('Editar Materias', action('Admin\CoursesController@edit', $uuid));
});

Breadcrumbs::register('Editar Materias', function($breadcrumbs) {
    $breadcrumbs->parent('Materias');
    $breadcrumbs->push('Editar Materias', action('Admin\CoursesController@update'));
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