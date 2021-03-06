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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'workers'], function () use ($router) {
  $router->get('/', 'WorkerController@index');
  $router->get('/{id}', 'WorkerController@show');
  $router->post('/', 'WorkerController@store');
  $router->put('/{id}', 'WorkerController@update');
});

$router->group(['prefix' => 'contracts'], function () use ($router) {
  $router->get('/', 'ContractController@index');
  $router->get('/{id}', 'ContractController@show');
  $router->post('/', 'ContractController@store');
  $router->put('/{id}', 'ContractController@update');
});