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