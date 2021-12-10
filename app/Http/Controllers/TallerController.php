<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use Illuminate\Http\Request;

class TallerController extends Controller
{
    //crea una funcion publica index
    public function index() {
        $taller = Taller::all();
        if (count($taller) > 0) {
            return response()->json([
                'error' => false,
                'message' => 'Se encontraron talleres registrados',
                'data' => $taller
            ], 200);
        }else {
            return response()->json([
                'error' => true,
                'message' => 'No se encontraron talleres registrados',
                'data' => $taller
            ], 404);
        }
    }

    public function store(Request $request) {
        $taller = Taller::create($request->all());

        if ($taller) {
            $validateData = $request->validate([
                'nombre' => 'required | max: 255',
                'descripcion' => 'required | max: 255',
                'horario_inicio' => 'required',
                'horario_fin' => 'required',
                'registro_id' => 'required | max: 100'
            ]);
        }
        if ($validateData) {
            return response()->json([
                'error' => false,
                'message' => 'Se creo correctamente el taller',
                'data' => $taller
            ], 201);
        }else {
            return response()->json([
                'error' => true,
                'message' => 'No se pudo crear el taller',
                'data' => $taller
            ], 500);
        }
    }

    public function show ($id) {
        $taller = Taller::find($id);

        if(empty($taller)) {
            return response()->json([
                'error' => true,
                'message' => 'No se pudo encontrar el taller',
                'data' => $taller
            ], 404);
        }else {
            return response()->json([
                'error' => false,
                'message' => 'Taller encontrado',
                'data' => $taller
            ], 200);
        }
    }

    public function update (Request $request, $id) {
        $taller = Taller::find($id);

        if(empty($taller)){
            return response()->json([
                'error' => true,
                'message' => 'No se pudo actualizar el taller',
                'data' => $taller
            ], 404);
        }else {
            $taller->update($request->all());
            return response()->json([
                'error' => false,
                'message' => 'Se actualizó el taller',
                'data' => $taller
            ], 200);
        }
    }

    public function destroy($id) {
        $taller = Taller::find($id);

        if($taller) {
            $taller->delete();
            return response()->json([
                'error' =>false,
                'message' => 'Se elimino el taller correctamente',
                'data' => $taller
            ], 200);
        }else {
            return response()->json([
                'error' =>true,
                'message' => 'No se pudo eliminar el taller',
                'data' => $taller
            ], 404);
        }
    }
}
