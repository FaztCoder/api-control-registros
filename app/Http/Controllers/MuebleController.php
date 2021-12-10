<?php

namespace App\Http\Controllers;

use App\Models\Mueble;
use Illuminate\Http\Request;

class MuebleController extends Controller
{
    //create a public function index
    public function index()
    {
        $mueble = Mueble::all();
        //return all the muebles
        if(count($mueble) > 0 ) {
            return response()->json([
                'error' => false,
                'message' => 'Se encontraron los muebles',
                'data' => $mueble
            ], 200);
        }else if(count($mueble) == 0){
            return response()->json([
                'error' => true,
                'message' => 'No hay muebles',
                'data' => $mueble
            ], 404);
        }
    }

    //create a public function store
    public function store (Request $request)
    {
        $mueble = Mueble::create($request->all());
        
        if ($mueble) {

            $validateData = $request->validate([
                'nombre' => 'required | max:255',
                'descripcion' => 'required | max:255',
                'cantidad' => 'required | numeric',
            ]);
            if($validateData) {
                    return response()->json([
                    'message' => 'Mueble creado correctamente',
                    'data' => $mueble
                ], 201);
            }else{
                return response()->json([
                    'message' => 'Error al guardar el mueble',
                    'data' => $mueble
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $mueble = Mueble::find($id);
        if (empty($mueble)) {
            return response()->json([
                'message' => 'Mueble no encontrado',
                'data' => $mueble
            ], 404);
        }else{
            return response()->json([
                'message' => 'Mueble encontrado',
                'data' => $mueble
            ], 200);
        }
    }

        public function update(Request $request, $id)
        {
            $mueble = Mueble::find($id);
            if ($mueble) {
                $mueble->update($request->all());
                return response()->json([
                    'message' => 'Mueble actualizado correctamente',
                    'data' => $mueble
                ], 200);
            }else {
                return response()->json([
                    'message' => 'Error!! Mueble no actualizado',
                    'data' => $mueble
                ], 404);
            }
        }

        public function destroy($id)
        {
            $mueble = Mueble::find($id);
            if ($mueble) {
                $mueble->delete();
                return response()->json([
                    'message' => 'Mueble eliminado correctamente',
                    'data' => $mueble
                ], 200);
            }else {
                return response()->json([
                    'data' => $mueble,
                    'message' => 'Mueble no eliminado'
                ], 404);
            }
        }
    
}
