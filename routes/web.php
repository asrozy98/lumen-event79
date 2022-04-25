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

$router->get('/', ['uses' => 'EventController@index']);

$router->get('event', ['uses' => 'EventController@index']);
$router->post('event', ['uses' => 'EventController@store']);
$router->get('event/add', ['uses' => 'EventController@create']);

$router->get('dashboard', ['uses' => 'EventController@dashboard']);
