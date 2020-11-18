<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
   public function pruebas(Request $request){
       return "Acción de pruebas de USER-CONTROLLER";
   }
   
   public function register(Request $request){
       
       // Recoger los datos del usuario por POST
       
       // Validar los datos
       
       // Cifrar la contraseña
       
       // Comprobar si el usuario existe ya (duplicado)
       
       // Crear el usuario
       
       // Devolver el mensaje correspondiente
       
        $data = array(
            'status' => 'error',
            'code' => 404,
            'message' => 'El usuario no se ha creado'
        );
        
        return response()->json($data, $data['code']);
       
   }
   
   public function login(Request $request){
       return "Acción de login de usuarios";
   }
}
