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

/*Route::get('/', function () {
    return view('home');
});*/

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/wall', 'WallController@index')->name('wall');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/perfil', 'UserController@index')->name('perfil');
Route::get('/editdatos', 'UserController@editDatos')->name('editdatos');
Route::post('/perfil/editdata', 'UserController@editData')->name('perfil/editdata');

Route::get('/newpost', 'PostController@newpost')->name('newpost');

Route::get('/test', 'TestController@index')->name('test');
