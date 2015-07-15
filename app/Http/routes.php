<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function ($router) {
    Route::get('/', ['uses' => 'DashboardController@index', 'as' => 'admin.dashboard.index']);

    Route::group(['prefix' => 'site-settings', 'middleware' => 'user-role', 'role' => 'admin'], function () {
        Route::get('/', ['uses' => 'SiteSettingsController@edit', 'as' => 'admin.site-settings.edit']);
        Route::post('/', ['uses' => 'SiteSettingsController@store', 'as' => 'admin.site-settings.store']);
    });

    Route::get('/profile', ['uses' => 'UsersController@editCurrent', 'as' => 'admin.users.edit-current']);
    Route::put('/profile', ['uses' => 'UsersController@updateCurrent', 'as' => 'admin.users.update-current']);

    Route::group(['prefix' => 'users', 'middleware' => 'user-role', 'role' => 'admin'], function () {
        Route::get('/', ['uses' => 'UsersController@index', 'as' => 'admin.users.index']);
        Route::get('/new', ['uses' => 'UsersController@create', 'as' => 'admin.users.create']);
        Route::post('/', ['uses' => 'UsersController@store', 'as' => 'admin.users.store']);
        Route::get('/{id}', ['uses' => 'UsersController@edit', 'as' => 'admin.users.edit']);
        Route::put('/{id}', ['uses' => 'UsersController@update', 'as' => 'admin.users.update']);
    });

    Route::group(['prefix' => 'students'], function () {
        Route::get('/', ['uses' => 'StudentsController@index', 'as' => 'admin.students.index']);
        Route::get('/new', ['uses' => 'StudentsController@create', 'as' => 'admin.students.create']);
        Route::post('/', ['uses' => 'StudentsController@store', 'as' => 'admin.students.store']);
        Route::get('/{id}', ['uses' => 'StudentsController@edit', 'as' => 'admin.students.edit']);
        Route::put('/{id}', ['uses' => 'StudentsController@update', 'as' => 'admin.students.update']);
        Route::get('/{id}/up', ['uses' => 'StudentsController@up', 'as' => 'admin.students.up']);
        Route::get('/{id}/down', ['uses' => 'StudentsController@down', 'as' => 'admin.students.down']);
    });

    Route::group(['prefix' => 'attendance'], function () {
        Route::get('/', ['uses' => 'ClassDaysController@index', 'as' => 'admin.class-days.index']);
        Route::get('/new', ['uses' => 'ClassDaysController@create', 'as' => 'admin.class-days.create']);
        Route::post('/', ['uses' => 'ClassDaysController@store', 'as' => 'admin.class-days.store']);
        Route::get('/{id}', ['uses' => 'ClassDaysController@edit', 'as' => 'admin.class-days.edit']);
        Route::put('/{id}', ['uses' => 'ClassDaysController@update', 'as' => 'admin.class-days.update']);
        Route::get('/{id}/up', ['uses' => 'ClassDaysController@up', 'as' => 'admin.class-days.up']);
        Route::get('/{id}/down', ['uses' => 'ClassDaysController@down', 'as' => 'admin.class-days.down']);
    });
});

Route::get('login', ['uses' => 'Auth\\SessionController@create', 'as' => 'auth.session.create']);
Route::post('login', ['uses' => 'Auth\\SessionController@store', 'as' => 'auth.session.store']);
Route::any('logout', ['uses' => 'Auth\\SessionController@destroy', 'as' => 'auth.session.destroy']);

Route::get('password-reset', ['uses' => 'Auth\\PasswordController@create', 'as' => 'auth.password.create']);
Route::post('password-reset', ['uses' => 'Auth\\PasswordController@store', 'as' => 'auth.password.store']);
Route::get('password-reset/{id}', ['uses' => 'Auth\\PasswordController@edit', 'as' => 'auth.password.edit']);
Route::post('password-reset/{id}', ['uses' => 'Auth\\PasswordController@update', 'as' => 'auth.password.update']);
