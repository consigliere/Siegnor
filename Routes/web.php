<?php
/**
 * web.php
 * Created by @anonymoussc on 6/27/2017 11:54 AM.
 */

Route::group(['middleware' => 'web', 'prefix' => 'siegnor', 'namespace' => 'App\Components\Siegnor\Http\Controllers'], function () {
    Route::get('/', 'SiegnorController@index');
    Route::get('/oauth2', 'SiegnorController@oauth2')->middleware('admin.user');
});