<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'nada'], function () {
    Route::group(['prefix' => 'api'], function () {
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout');

        Route::group(['middleware' => 'auth:nada'], function () {
            Route::get('user', 'UserController@user');
            Route::get('roles', 'UserController@roles');
            Route::get('permissions', 'UserController@permissions');
            Route::get('menus', 'UserController@menus');

            Route::group(['prefix' => 'data'], function() {
                Route::get('users', 'DataController@index');
            });

            Route::group(['prefix' => 'item'], function() {
                Route::get('users/{id}', 'DataController@item');
                Route::post('/{source}', 'DataController@saveItem');
                Route::delete('/{source}/{id}', 'DataController@destroyItem');
                Route::delete('/{source}', 'DataController@destroyItems');
            });

            Route::group(['prefix' => 'structures'], function() {
                Route::get('/grid/users', 'NadaController@index');
                Route::get('/form/users', 'NadaController@edit');
            });
        });
    });

    Route::get('/{any?}', function () {
        return view('nada');
    })->where(['any' => '.*']);
});
