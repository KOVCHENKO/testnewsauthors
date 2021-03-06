<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('news/')->group(function() {
    Route::post('get_all', 'NewsController@getAll');
    Route::get('get_by_id/{id}', 'NewsController@getById');
});

Route::prefix('authors/')->group(function() {
    Route::get('get_all/', 'AuthorController@getAll');
});

