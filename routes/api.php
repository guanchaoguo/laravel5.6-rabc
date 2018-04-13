<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

// v1 version API
// choose version add this in header    Accept:application/vnd.lumen.admin_v1+json
$api->version(['v1'],['namespace' => 'App\Http\Controllers'], function ($api){
    // login
    $api->post('login', 'AuthController@login');
    $api->get('exmaple', 'ExampleController@index');

    /*
     * menu
     */
    $api->get('menu', 'MenuController@index');
    $api->get('menu/{id}', 'MenuController@show');
    $api->post('menu', 'MenuController@create');
    $api->put('menu/{id}', 'MenuController@update');
    $api->delete('menu', 'MenuController@destroy');

    /*
    * role
    */
    $api->get('role', 'RoleController@index');
    $api->get('role/{id}', 'RoleController@show');
    $api->post('role', 'RoleController@create');
    $api->put('role/{id}', 'RoleController@update');
    $api->delete('role', 'RoleController@destroy');

    /*
    * permission
    */
    $api->get('permission', 'PermissionController@index');
    $api->get('permission/{id}', 'PermissionController@show');
    $api->post('permission', 'PermissionController@create');
    $api->put('permission/{id}', 'PermissionController@update');
    $api->delete('permission', 'PermissionController@destroy');
});

// auth
$api->version(['v1'],['namespace' => 'App\Http\Controllers','middleware' =>['auth:api','permission']], function ($api){
    $api->post('logout', 'AuthController@logout');
    $api->post('refresh', 'AuthController@refresh');
    $api->post('me', 'AuthController@me');
});


