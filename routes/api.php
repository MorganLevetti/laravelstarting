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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'App\Http\Controllers\API\Auth\LoginController@login');
Route::post('register', 'App\Http\Controllers\API\Auth\RegisterController@register');
Route::post('sendPasswordResetLink', 'App\Http\Controllers\API\Auth\ForgotPasswordController@forgetPassword');

Route::get('/reset_password_email/{token}', 'App\Http\Controllers\API\Auth\ResetPasswordController@showResetForm')->name('password.reset.form');
Route::post('/reset_password_email', 'App\Http\Controllers\API\Auth\ResetPasswordController@resetPassword')->name('password.reset');


// Route::post('/me', [LoginController::class, 'me'])->middleware('auth:sanctum'); 
// Route::post('register', 'ApiController@register');
// Route::post('logout', 'ApiController@logout');
// Route::post('refresh', 'ApiController@refresh');
// Route::post('token', 'ApiController@token');

// // BROWSE
// Route::get('/{datatype}', 'ApiController@browse');

// // READ
// Route::get('/{datatype}/{id}', 'ApiController@read');

// // EDIT
// Route::put('/{datatype}/{id}', 'ApiController@edit');

// // ADD
// Route::post('/{datatype}', 'ApiController@add');

// // DELETE
// Route::delete('/{datatype}/{id}', 'ApiController@delete');
