<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin::'
], function()
{
    Route::get('/', ['as' => 'login.form', 'uses' => 'AuthController@getLoginForm']);
    Route::post('login', ['as' => 'login.check', 'uses' => 'AuthController@login']);

    Route::group([
        'middleware' => ['auth-admin']
    ], function()
    {
        Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

        /* Settings- change email and password */
        Route::get('settings', ['as' => 'settings', 'uses' => 'DashboardController@editSettings']);
        Route::patch('settings', ['as' => 'settings.update', 'uses' => 'DashboardController@updateSettings']);

        /* Places */
        Route::resource('place', 'PlaceController', ['names' => [
            'index' => 'place.index',
            'create' => 'place.create',
            'store' => 'place.store',
            'show' => 'place.show',
            'edit' => 'place.edit',
            'update' => 'place.update',
            'destroy' => 'place.destroy'
        ]]);
        Route::get('place/show-row/{id}', ['as' => 'place.showRow', 'uses' => 'PlaceController@showRow']);
        Route::get('place/toggle-active/{id}', ['as' => 'place.toggleActive', 'uses' => 'PlaceController@toggleActive']);

        /* Map Routes */
        Route::resource('route', 'MapRouteController', ['names' => [
            'index' => 'route.index',
            'create' => 'route.create',
            'store' => 'route.store',
            'show' => 'route.show',
            'edit' => 'route.edit',
            'update' => 'route.update',
            'destroy' => 'route.destroy'
        ]]);
        Route::get('route/show-row/{id}', ['as' => 'route.showRow', 'uses' => 'MapRouteController@showRow']);
        Route::get('route/toggle-active/{id}', ['as' => 'route.toggleActive', 'uses' => 'MapRouteController@toggleActive']);

        /* Disability Types */
        Route::resource('disability', 'DisabilityTypeController', ['names' => [
            'index' => 'disability.index',
            'create' => 'disability.create',
            'store' => 'disability.store',
            'show' => 'disability.show',
            'edit' => 'disability.edit',
            'update' => 'disability.update',
            'destroy' => 'disability.destroy'
        ]]);
        Route::get('disability/show-row/{id}', ['as' => 'disability.showRow', 'uses' => 'DisabilityTypeController@showRow']);

        /* Pins */
        Route::resource('pin', 'PinController', ['names' => [
            'index' => 'pin.index',
            'create' => 'pin.create',
            'store' => 'pin.store',
            'show' => 'pin.show',
            'edit' => 'pin.edit',
            'update' => 'pin.update',
            'destroy' => 'pin.destroy'
        ]]);
        Route::get('pin/show-row/{id}', ['as' => 'pin.showRow', 'uses' => 'PinController@showRow']);
        Route::get('pin/toggle-active/{id}', ['as' => 'pin.toggleActive', 'uses' => 'PinController@toggleActive']);
        Route::get('pins/export/{fileType?}', ['as' => 'pin.export', 'uses' => 'PinController@exportPins']);
    });
});