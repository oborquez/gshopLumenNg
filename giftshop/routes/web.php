<?php

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

$api_version = "api/v1/";

$router->get('/', function () use ($router) {
    return $router->app->version();
});



$router->group(['middleware' => ['auth','cors']], function() use ($router, $api_version){

    // user auth endpoints
    $router->get($api_version.'user/all', ['uses' => "UserController@all"] );
    $router->post($api_version.'user/create', ['uses' => "UserController@create"] );
    $router->post($api_version.'user/delete', ['uses' => "UserController@delete"] );    

    //categories auth endpoints
    $router->post($api_version.'categories/create', ['uses' => "CategoriesController@createCategory"] );
    $router->post($api_version.'categories/delete', ['uses' => "CategoriesController@deleteCategory"] );


    // products auth endpoints
    $router->post($api_version.'products/create', ['uses' => "ProductsController@createProduct"] );
    $router->post($api_version.'products/delete', ['uses' => "ProductsController@deleteProduct"] );
   
});

$router->group(['middleware' => ['cors']], function() use ($router, $api_version){

    $router->get($api_version.'user', ['uses' => "UserController@index"] );

    // user endpoints
    $router->post($api_version.'user/login', ['uses' => "UserController@getUserToken"] );

    //categories endpoints
    $router->get($api_version.'categories/all', ['uses' => "CategoriesController@all"] );

    // products endpoints
    $router->get($api_version.'products/all', ['uses' => "ProductsController@all"] );
    $router->get($api_version.'products/{category_id}', ['uses' => "ProductsController@byCategory"] );
    $router->post($api_version.'products/byFilters', ['uses' => "ProductsController@byFilters"] );


});
