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
            Route::get('', 'UserController@user');
            Route::put('', 'UserController@update');
            Route::get('centers', 'UserController@favourites');
            Route::get('subscription', 'UserController@subscription');
            Route::post('subscription', 'SubscriptionController@subscribe');
            Route::get('entries', 'UserController@entries');
            Route::get('entries/pending', 'UserController@pendingClasses');
            Route::apiResource('children', 'ChildrenController')->except(['update', 'show']);
        });
        Route::get('subscriptions', 'SubscriptionController@list');
        Route::apiResource('categories', 'CategoryController')
            ->only(['index'])
            ->names(['index' => 'categories.list']);
        Route::apiResource('categories.templates', 'ClassTemplateController')
            ->only(['index'])
            ->names(['index' => 'templates.list'])
            ->shallow();
        Route::apiResource('categories.centers', 'CenterController')
            ->only(['index', 'show'])
            ->names(['index' => 'centers.list'])
            ->shallow();
        Route::get('centers', 'CenterController@all');
        Route::post('centers/{center}/like', 'CenterController@like');
        Route::delete('centers/{center}/like', 'CenterController@dislike');
        Route::apiResource('templates.entities', 'ClassEntityController')
            ->only(['index'])
            ->names(['index' => 'entities.list'])
            ->shallow();
        Route::group(['middleware' => 'subscription.active'], function () {
            Route::apiResource('entities.entries', 'ClassEntryController')
                ->only(['store'])
                ->names(['store' => 'entities.enter'])
                ->shallow();
            Route::post('entries/{entry}/approve', 'ClassEntryController@approve');
            Route::post('entries/{entry}/visit', 'ClassEntryController@visit');
        });
        Route::apiResource('avatars', 'AvatarPackController')->only(['index'])->names([
            'index' => 'avatars.list'
        ]);
    });
});
