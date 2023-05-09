<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::post('login', 'ApiController@login'); 
Route::post('register', 'ApiController@register');
Route::post('logout', 'ApiController@logout');
Route::post('refresh', 'ApiController@refresh');
Route::post('token', 'ApiController@token');

// BROWSE
Route::get('/{datatype}', 'ApiController@browse');

// READ
Route::get('/{datatype}/{id}', 'ApiController@read');

// EDIT
Route::put('/{datatype}/{id}', 'ApiController@edit');

// ADD
Route::post('/{datatype}', 'ApiController@add');

// DELETE
Route::delete('/{datatype}/{id}', 'ApiController@delete');

