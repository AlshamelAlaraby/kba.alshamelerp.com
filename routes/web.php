<?php
use \Illuminate\Routing\Router;

Route::group(['middleware' => ['auth:admin']], function (Router $router) {
    Route::get('/', 'HomeController@index');
});