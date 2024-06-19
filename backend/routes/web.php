<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    
    // Protected routes
    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->get('profile', function () {
            return response()->json(['message' => 'This is a protected route.']);
        });
    });
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    
    $router->group(['middleware' => 'auth'], function () use ($router) {
        // Rute untuk CRUD produk
        $router->get('products', 'ProductController@index');
        $router->get('products/{id}', 'ProductController@show');
        $router->post('products', 'ProductController@store');
        $router->put('products/{id}', 'ProductController@update');
        $router->delete('products/{id}', 'ProductController@destroy');
    });
});


