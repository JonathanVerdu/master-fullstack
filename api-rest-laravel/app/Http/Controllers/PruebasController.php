<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebasController extends Controller
{
    public function index(){
        $titulo = "Animales";
        $animales = ["perro","gato","tigre"];
        return view('pruebas.index', array(
            'animales' => $animales,
            'titulo' => $titulo
        ));
    }
}
