<?php

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
    Route::post('auth', 'AuthController@auth');
    Route::post('auth/verify', 'AuthController@verify');
    Route::post('login', 'AuthController@loginByUsername');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::apiResource('images', 'ImageController')->only(['store']);
        Route::group(['prefix' => 'user'], function () {
            Route::put('', 'UserController@update');
            Route::apiResource('children', 'ChildrenController')->except(['update', 'show']);
        });
        Route::apiResource('categories', 'CategoryController')->only(['index'])->names([
            'index' => 'categories.list'
        ]);
        Route::apiResource('avatars', 'AvatarPackController')->only(['index'])->names([
            'index' => 'avatars.list'
        ]);
    });
});
