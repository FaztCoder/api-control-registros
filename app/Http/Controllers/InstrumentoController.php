<?php

namespace App\Http\Controllers;

use App\Http\Resources\Instrumento\InstrumentoCollection;
use App\Http\Resources\Instrumento\InstrumentoResource;
use App\Models\Instrumento;
use Illuminate\Http\Request;

class InstrumentoController extends Controller
{
    //createa public function index
    public function index()
    {
        $instrumento = Instrumento::all();
        if (count($instrumento) > 0) {
            return response()->json([
                'error' => false,
                'message' => 'Se encontraron instrumentos registrados',
                'data' => $instrumento
            ], 200);
        }else {
            return response()->json([
                'error' => true,
                'message' => 'No se encontraron instrumentos registrados',
                'data' => $instrumento
            ], 404);
        }
    }

    public function store(Request $request)
    {
        //create a new store
        $instrumento = Instrumento::create($request->all());

        //store the record whit a conditional statement
        if ($instrumento) {
            $validateData = $request->validate([
                'nombre' => 'required | max:255',
                'descripcion' => 'required | max:255',
                'registro_id' => 'required|max:255',
            ]);

            if($validateData) {
                return new InstrumentoResource($instrumento);
            }else {
                return response()->json([
                    'message' => '¡Error! No se pudo registrar el nstrumento',
                    'data' => $instrumento
                ]);
            }
        } 
    }

        public function show($id)
    {
        //find the record with the id and save it in a variable
        $instrumento = Instrumento::find($id);

        //validated that the record exists whit a conditional
        if (empty($instrumento)) {
            //if the record does not exist return a 404 error
            return new InstrumentoResource($instrumento);
        }else{
            //if the record exists return the record whit a response and message
            return response()->json([
                'message' => 'Instrumento encontrado/registrado', 'instrumento' => $instrumento,
                'data' => $instrumento
            ], 200);
        }

    }

    public function update(Request $request, $id)
    {
        //find the record with the id and save it in a variable
        $instrumento = Instrumento::find($id);

        //validated that the record exists whit a conditional
        if (empty($instrumento)) {
            //if the record does not exist return a 404 error
            return response()->json([
                'message' => 'Instrumento no encontrado/registrado'
            ], 404);
        }else{
            //if the record exists update the record whit a response and message
            $instrumento->update($request->all());
            return new InstrumentoResource($instrumento);
        }
    }

    public function destroy($id)
    {
        //find the record with the id and save it in a variable
        $instrumento = Instrumento::find($id);

        //validated that the record exists whit a conditional
        if (empty($instrumento)) {
            //if the record does not exist return a 404 error
            return new InstrumentoResource($instrumento);
        }else{
            //if the record exists delete the record whit a response and message
            $instrumento->delete();
            return response()->json([
                'message' => 'Instrumento eliminado',
                'data' => $instrumento
            ], 200);
        }
    }
}