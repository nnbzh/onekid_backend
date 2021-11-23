<?php

use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'v1'], function () {
    Route::group(['namespace' => 'App\Http\Controllers\Api\v1'], function () {
        Route::post('auth', 'AuthController@auth');
        Route::post('auth/verify', 'AuthController@verify');
        Route::post('login', 'AuthController@loginByUsername');
        Route::group(['middleware' => 'auth:api'], function ()  {
            Route::group(['prefix' => 'user'], function () {
                Route::put('', 'UserController@update');
                Route::apiResource('children');
            });
        });
    });
});
