<?php

use App\User;
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

//unprotected routes
Route::post('users','ApiController@storeUser');

//route protected by grant password
Route::middleware('auth:api')->group(function () {
    Route::get('me','ApiController@me');
    Route::get('tasks','ApiController@tasks')->name('tasks.index');
    Route::post('tasks/store','ApiController@storeTask')->name('tasks.store');
    Route::delete('tasks/{id}/delete','ApiController@deleteTask')->name('tasks.delete');
});

//route protected by grant client credentials
Route::middleware('client')->group(function () {
    Route::get('users','ApiController@users');
});
