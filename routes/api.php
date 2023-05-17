<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', 'App\Http\Controllers\API\Auth\AuthController@login');
Route::post('logout', 'App\Http\Controllers\API\Auth\AuthController@logout');
Route::post('register', 'App\Http\Controllers\API\Auth\RegisterController@register');
Route::get ('verify', 'App\Http\Controllers\API\Auth\RegisterController@verifyEmail');
Route::post ('user', 'App\Http\Controllers\API\UserController@profile');


