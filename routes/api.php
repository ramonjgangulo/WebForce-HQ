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

Route::middleware('jwt')->get('/user', function (Request $request) {
    $user =\Illuminate\Support\Facades\Auth::user();
    if($user==null)
        return response()->json(['Error' => 'There is no user authenticated'],401);
    return response()->json($user,200);
});

Route::post('login','Auth\LoginController@loginAttempt');
Route::get('logout','Auth\LoginController@logout');

Route::apiResource('products','ProductController');

Route::apiResource('media','MediaController');

//Restricts all endpoints from UserController
Route::middleware('jwt')->apiResource('users','UserController');
