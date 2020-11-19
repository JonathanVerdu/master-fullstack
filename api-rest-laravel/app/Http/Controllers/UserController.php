<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);
            
            if ($validate->fails()) {
                
                // -- Validación errónea --
                
                // Montar data correspondiente
                $data = array(
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'El usuario no se ha creado',
                    'errors' => $validate->errors()
                );
                
            } else {
                
                // -- Validación pasada correctamente --
                
                // Cifrar la contraseña
                $pwd = hash('sha256',$params->password);
                
                // Crear el usuario
                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->role = "ROLE_USER";
                
                 // Guardar el usuario
                $user->save(); // hace un insert en la base de datos con todos los datos del objeto     

                // Montar data correspondiente
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'El usuario se ha creado correctamente',
                    'user' => $user
                );
                               
            }
            
        } else {

            // -- Validación con campo faltante --
            
            // Montar data correspondiente
            $data = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'Los datos enviados no son correctos',
            );
            
        }
        
        return response()->json($data, $data['code']);
        
    }

    public function login(Request $request) {
        
        $jwtAuth = new \JwtAuth();
        
        // Recibir datos por POST
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json,true);
          
        // Validar esos datos
        $validate = \Validator::make($params_array, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            // -- Validación errónea --

            // Montar data correspondiente
            $signup = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'El usuario no se ha podido loguear',
                'errors' => $validate->errors()
            );
        } else {            
            // Cifrar la contraseña
            $pwd = hash('sha256',$params->password);

            // Devolver Token o datos
            $signup = $jwtAuth->signup($params->email,$pwd);
            if(isset($params->getToken)){
                $signup = $jwtAuth->signup($params->email,$pwd,true);
            }               
        }
        
        return response()->json($signup, 200);   
        
    }

}
