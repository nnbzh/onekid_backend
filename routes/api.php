<?php

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
        Route::post('auth', 'AuthController@loginByPhone')->middleware(['throttle:5,5']);
        Route::post('login', 'AuthController@loginByUsername');
        Route::post('verify', 'AuthController@verify');
        Route::group(['middleware' => 'auth:api'], function ()  {
            Route::group(['prefix' => 'user'], function ()  {
                Route::get('', 'UserController@user');
                Route::group(['prefix' => 'profile'], function ()  {
                    Route::get('', 'UserProfileController@get');
                    Route::post('', 'UserProfileController@create');
                });
                Route::group(['prefix' => 'children'], function ()  {
                    Route::get('', 'UserController@children');
                    Route::post('', 'UserController@addChild');
                });
            });
            Route::group(['prefix' => 'categories'], function ()  {
                Route::get('', 'CategoryController@list');
                Route::get('{id:[0-9]+}', 'CategoryController@get');
            });
        });
        Route::get('genders', 'GenderController@list');
    });
});
