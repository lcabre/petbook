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
Route::get('/perfil', 'PerfilController@index')->name('perfil');
Route::get('/mascotas', 'MascotaController@index')->name('mascotas');
Route::get('/mascotas/agregar', 'MascotaController@agregarMascotaView')->name('agregarMascotas');

Route::post('/perfil/editdata', 'PerfilController@editData')->name('perfil/editdata');
Route::post('/perfil/uploadperfilimage', 'PerfilController@uploadPerfilImage')->name('perfil/uploadperfilimage');
Route::post('/mascotas/add', 'MascotaController@addMascota')->name("addMascota");

Route::get('/raza/{id}', 'RazaController@getById')->name("getRazaById");
Route::get('/raza/tipo/{idTipo}', 'RazaController@getByTipo')->name("getRazaByTipo");

//Route::get('/newpost', 'PostController@newpost')->name('newpost');


Route::get('/storage/perfil_images/{filename}', function ($filename) {
    $path = storage_path('app/perfil_images/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
