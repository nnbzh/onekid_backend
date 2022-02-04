<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () {
    Route::crud('class-template', 'ClassTemplateCrudController');
    Route::crud('business', 'BusinessCrudController');
    Route::crud('class-entity', 'ClassEntityCrudController');
    Route::crud('class-category', 'ClassCategoryCrudController');
    Route::crud('center', 'CenterCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('avatar-pack', 'AvatarPackCrudController');
    Route::crud('subscription', 'SubscriptionCrudController');
    Route::crud('user-subscription', 'UserSubscriptionCrudController');
});