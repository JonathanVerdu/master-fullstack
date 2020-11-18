<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller {

    public function pruebas(Request $request) {
        return "Acción de pruebas de USER-CONTROLLER";
    }

    public function register(Request $request) {

        // Recoger los datos del usuario por POST
        $json = $request->input('json', null);
        $params = json_decode($json); // decodificado el json en objeto
        $params_array = json_decode($json, true); // decodificado el json en array

        if (!empty($params) && !empty($params_array)) {

            // Limpiar datos
            $params_array = array_map('trim', $params_array); // quitamos los espacios sobrantes
            // Validar los datos
            $validate = \Validator::make($params_array, [
                        'name' => 'required|alpha',
                        'surname' => 'required|alpha',
                        'email' => 'required|email',
                        'password' => 'required'
            ]);

            if ($validate->fails()) {
                
                // Validación errónea
                $data = array(
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'El usuario no se ha creado',
                    'errors' => $validate->errors()
                );
                
            } else {
                
                // Validación pasada correctamente
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'El usuario se ha creado correctamente',
                );
                
                 // Cifrar la contraseña
                // Comprobar si el usuario existe ya (duplicado)
                // Crear el usuario
                // Devolver el mensaje correspondiente
                
            }
        } else {
            
            // Validación con campo faltante
            $data = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Los datos enviados no son correctos',
            );
            
        }

       



        return response()->json($data, $data['code']);
    }

    public function login(Request $request) {
        return "Acción de login de usuarios";
    }

}
