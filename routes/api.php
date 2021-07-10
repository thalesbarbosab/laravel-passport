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

//unprotected routes
Route::post('user/reset', 'Api\\UserController@reset')->name('user.reset');
Route::post('user', 'Api\\UserController@store')->name('user.store');

//route protected by grant password
Route::group(['middleware' => 'auth:api'], function () {
    //user endpoints
    Route::get('users', 'Api\\UserController@index')->name('user.index');
    Route::get('user/me', 'Api\\UserController@me')->name('user.personal.me');
    Route::put('user', 'Api\\UserController@update')->name('user.personal.update');
    Route::put('user/change-password', 'Api\\UserController@changePassword')->name('user.personal.changePassword');
    Route::post('user/logout', 'Api\\UserController@logout')->name('user.personal.logout');


});
