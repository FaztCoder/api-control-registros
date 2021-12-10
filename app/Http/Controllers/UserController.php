<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Validator;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index () {
        $usuario = User::all();

        if(count($usuario) > 0) {
            return response()->json([
                'error' => false,
                'message' => 'Se encontraron usuarios registrados',
                'data' => $usuario
            ], 200);
        }else {
            return response()->json([
                'error' => true,
                'message' => 'No se encontraron usuarios registrados',
                'data' => $usuario
            ], 404);
        }
    }

    public function store (Request $request) {
        $usuario = User::create($request->all());

        if($usuario) {
            $validateData = $request->validate([
                'nombre' => 'required | max: 255',
                'email' => 'required | max: 100',
                'contraseña' => 'required | numeric',
                'rol_id' => 'required | max: 100'
            ]);
        }
        if($validateData) {
            return response()->json([
                'error' => false,
                'message' => 'Se actualizo correctamente el usuario',
                'data' => $usuario
            ], 201);
        }else {
            return response()->json([
                'error' => true,
                'message' => 'No se pudo actulizar el usuario',
                'data' => $usuario
            ], 500);
        }
    }

    public function show ($id) {
        $usuario = User::find($id);

        if(empty($usuario)) {
            return response()->json([
                'error' => true,
                'message' => 'No se encontraron usuarios registrados',
                'data' => $usuario
            ], 404);
        }else {
            return response()->json([
                'error' => false,
                'message' => 'Se encontraron usuarios registrados',
                'data' => $usuario
            ], 200);
        }

    }

    public function update (Request $request, $id) {
        //Primera forma para encontrar un user
        // $usuario = User::find($id);
        $usuario = User::find($id);
        //Empty es lo mismo que decir "if (!$usuario)"
        if(empty($usuario)) {
            return response()->json([
                'error' => true,
                'message' => 'No se pudo actulizar el usuario',
                'data' => $usuario
            ], 404);
        }else {
            return response()->json([
                $usuario->update($request->all()),
                'error' => false,
                'message' => 'Se actualizo el usuario correctamente',
                'data' => $usuario
            ], 201);
        }
    }

    public function destroy ($id) {
        $usuario = User::find($id);

        if($usuario) {
            $usuario->delete();
            return response()->json([
                'error' =>false,
                'message' => 'Se elimino el usuario correctamente',
                'data' => $usuario
            ], 200);
        }else {
            return response()->json([
                'error' =>true,
                'message' => 'No se pudo eliminar el usuario',
                'data' => $usuario
            ], 404);
        }
    }
}
