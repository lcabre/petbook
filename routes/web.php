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
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/wall', 'ViewController@indexWall')->name('wall');
Route::get('/wall/mascota/{id}', 'ViewController@wallMascota')->name("wallMascota");
Route::get('/perfil', 'ViewController@indexPerfil')->name('perfil');
Route::get('/mascotas', 'ViewController@indexMascota')->name('mascotas');
Route::get('/mascotas/agregar', 'ViewController@agregarMascota')->name('agregarMascotas');
Route::get('/mascotas/edit/{id}', 'ViewController@editMascota')->name("view.editMascota")->middleware('isOwner');

Route::post('/perfil/editdata', 'PerfilController@editData')->name('perfil/editdata');
Route::post('/perfil/uploadperfilimage', 'PerfilController@uploadPerfilImage')->name('perfil/uploadperfilimage');
Route::post('/mascotas/add', 'MascotaController@addMascota')->name("addMascota");
Route::post('/mascotas/edit/', 'MascotaController@editMascota')->name("editMascota");
Route::post('/mascotas/remove/', 'MascotaController@removeMascota')->name("removeMascota");
Route::post('/mascotas/uploadperfilimage', 'MascotaController@uploadPerfilImage')->name('mascotas/uploadperfilimage');
Route::post('/mascotas/post/newpost', 'postController@newPost')->name("newPost");

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

Route::get('/storage/post_images/{filename}', function ($filename) {
    $path = storage_path('app/post_images/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
