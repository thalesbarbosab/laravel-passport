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



//route protected by grant password
Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});

//route protected by grant client credentials
Route::middleware('client')->get('users', function (Request $request) {
    return response()->json(User::all());
});
