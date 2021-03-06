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

// Cargando clases
Use App\Http\Middleware\ApiAuthMiddleware;

// RUTAS DE PRUEBAS -----------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

//Ruta con datos obtenidos en ella misma
Route::get('/pruebas/{nombre?}', function($nombre = null){
    
    $texto = '<h2>Texto desde una ruta</h2>';
    $texto .= 'Nombre: '.$nombre;
    
    return view('pruebas',array(
       "texto" => $texto 
    ));    
});

// Ruta con datos obtenidos de un controlador
Route::get('/animales','PruebasController@index');

// Ruta con datos obtenidos de la BBDD
Route::get('/test-orm','PruebasController@testOrm');

// RUTAS DEL API ----------------------------------------------------------

/* Métodos HTTP comunes
    * GET: Conseguir datos o recursos.
    * POST: Guardar datos, recursos o hacer lógica desde un formulario
    * PUT: Actualizar datos o recursos
    * DELETE: Eliminar datos o recursos
*/

// Rutas de prueba
//Route::get('/usuario/pruebas', 'UserController@pruebas');
//Route::get('/categoria/pruebas', 'CategoryController@pruebas');
//Route::get('/entrada/pruebas', 'PostController@pruebas');
    
// Rutas del controlador de usuario
Route::post('/api/register', 'UserController@register');
Route::post('/api/login', 'UserController@login');
Route::put('/api/user/update', 'UserController@update');
Route::post('/api/user/upload','UserController@upload')->middleware(ApiAuthMiddleware::class);
Route::get('/api/user/avatar/{filename}','UserController@getImage');
Route::get('/api/user/detail/{id}','UserController@detail');

// Rutas del controlador de categorías
Route::resource('/api/category', 'CategoryController');

// Rutas del controlador del controlador de entradas (Post)
Route::resource('/api/post', 'PostController');