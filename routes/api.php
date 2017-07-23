<?php

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

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('login', ['as' => 'login', 'uses' => 'AuthController@store']);

    Route::middleware(['auth.token'])->group(function () {
        Route::post('logout', ['as' => 'logout', 'uses' => 'AuthController@destroy']);
        Route::get('me', 'AuthController@show');

        Route::resource('users', 'UserController');
        Route::resource('groups', 'GroupController');
        Route::resource('memberships', 'MembershipController');
        Route::resource('data', 'DataController');
    });
});
