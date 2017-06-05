<?php

Route::group(['middleware' => 'web', 'prefix' => 'siegnor', 'namespace' => 'App\\Components\Siegnor\Http\Controllers'], function () {
    Route::get('/', 'SiegnorController@index');
    Route::get('/oauth2', 'SiegnorController@oauth2')->middleware('admin.user');
});

Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Voyager::routes();
    });
});