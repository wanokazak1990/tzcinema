<?php
/*DB::listen(function($query) {
    var_dump($query->sql, $query->bindings);
});*/
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cinema/update','Cinema\CinemaParserController@update')->name('cinema.update');
Route::get('/cinema','Cinema\CinemaController@index')->name('cinema.index');
Route::post('/cinema/search','Cinema\CinemaController@search')->name('cinema.search');

