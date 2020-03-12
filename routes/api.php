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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login','Auth\LoginController@loginAttempt');
Route::get('logout','Auth\LoginController@logout');

Route::middleware('jwt')->apiResource('products','ProductController');

Route::apiResource('media','MediaController');

Route::middleware('jwt')->apiResource('users','UserController');
