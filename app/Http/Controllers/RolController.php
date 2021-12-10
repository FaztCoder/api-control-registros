<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    //crea una funcion publica llamada index
    public function index() {
        $rol = Rol::all();
        if(count($rol) > 0) {
            return response()->json([
                'message' => 'Se encontraron roles',
                'data' => $rol
            ], 200);
        }else {
            return response()->json([
                'message' => 'No se encotnraron roles registados',
                'data' => $rol
            ], 404);
        }
    }

    public function store (Request $request) {
        $rol = Rol::create($request->all());
        if($rol) {
            $validateData = $request->validate([
                'tipo_rol' => 'required | max: 13'
            ]);
            if( $validateData ) {
                return response()->json([
                    'message' => 'Se registro correctamente el rol',
                    'data' => $rol
                ], 201);
            }else {
                return response()->json([
                    'message' => 'No se pudo crear el rol',
                    'data' => $rol
                ], 500);
            }

        }
    }

    public function show ($id) {
        $rol = Rol::find($id);
        if(empty($rol)) {
            return response()->json([
                'error' => true,
                'message' => 'No se encontro el rol',
                'data' => $rol
            ], 404);
        }else {
            return response()->json([
                'error' => false,
                'message' => 'Rol encontrado',
                'data' => $rol
            ], 200);
        }
    }

    public function update(Request $request, $id) {
        $rol = Rol::find($id);

        if(empty($rol)) {
            return response()->json([
                'error' => true,
                'message' => 'No se pudo actualizar el rol',
                'data' => $rol
            ], 404);
        }else {
            $rol->update($request->all());
            return response()->json([
                'error' => false,
                'message' => 'El rol se actualizo correctamente',
                'data' => $rol
            ], 200);
        }
    }

    public function destroy ($id) {
        $rol = Rol::find($id);
        if($rol) {
            $rol->delete();
            return response()->json([
                'error' => true,
                'message' => 'Rol eliminado correctamente',
                'data' => $rol
            ], 200);
        }else {
            return response()->json([
            'error' => false,
            'message' => 'No se pudo eliminar el rol correctamente',
            'data' => $rol
            ], 404);
        }
    }
    
}
