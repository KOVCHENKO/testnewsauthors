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
    Route::get('get_all/{page}', 'NewsController@getAll');
    Route::post('get_filtered', 'NewsController@getFiltered');
});

Route::prefix('authors/')->group(function() {
    Route::get('get_all/', 'AuthorController@getAll');
});

