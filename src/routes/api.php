<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::namespace('Admin')
    ->middleware('jwt.auth')
    ->group(function() {

    Route::get('/', function () {
        return response()->json(['message' => 'Laravel API', 'status' => 'Connected']);;
    });

    Route::resource('customers', 'CustomerController',  ['except' => ['create', 'edit']]);
    Route::resource('orders', 'OrderController',  ['except' => ['create', 'edit']]);
    Route::resource('orderservices', 'OrderServiceController',  ['except' => ['create', 'edit']]);
    Route::resource('services', 'ServiceController',  ['except' => ['create', 'edit']]);
    Route::resource('tenants', 'TenantController',  ['except' => ['create', 'edit']]);
    Route::resource('users', 'UserController',  ['except' => ['create', 'edit']]);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'Auth',
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::get('/', function () {
    return response()->json(['message' => 'Laravel API', 'status' => 'Connected']);;
});
