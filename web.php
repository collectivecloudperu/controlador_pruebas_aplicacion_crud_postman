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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/postres/crear', 'PostresController@store')->name('/postres/crear');
Route::get('/postres/leer/', 'PostresController@index')->name('/postres/leer');
Route::post('/postres/actualizar/{id}', 'PostresController@update')->name('/postres/actualizar/{id}');
Route::post('/postres/borrar/{id}', 'PostresController@destroy')->name('/postres/borrar/{id}');

