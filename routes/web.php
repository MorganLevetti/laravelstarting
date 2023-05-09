<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('login', '@login'); 
Route::post('register', '@register');
Route::post('logout', '@logout');
Route::post('refresh', '@refresh');
Route::post('token', '@token');

// BROWSE
Route::get('/{datatype}', '@browse');

// READ
Route::get('/{datatype}/{id}', '@read');

// EDIT
Route::put('/{datatype}/{id}', '@edit');

// ADD
Route::post('/{datatype}', '@add');

// DELETE
Route::delete('/{datatype}/{id}', '@delete');

