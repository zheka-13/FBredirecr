<?php

/** @var Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Laravel\Lumen\Routing\Router;

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/', 'HomeController@home');

    $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function () use ($router){
        $router->get('/users', [
            "as" => "users", "uses" => 'UsersController@index'
        ]);
    });
});
