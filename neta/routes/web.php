<?php
session_start();
use Illuminate\Http\Request;
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

$router->group(['prefix' => 'shapes'], function () use ($router) {
    //route to json test form 
    $router->get('/', ['as'=>'shapes.index', 'uses'=>'ShapeController@index']);
    //route to rendering endpoint
    $router->post('render', ['as'=>'shapes.render','uses'=>'ShapeController@render']);
    
});


