<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    //create a public function called index
    public function index()
    {
        $registro = Registro::all();
        //return registro from the database
        if(count($registro) > 0 ) {
            return response()->json([
                'data' => $registro
            ], 200);
        }else {
            return response()->json([
                'message' => 'No se encontraron registros para mostrar'
            ], 404);
        }
    }

    //create a public function called store
    public function store(Request $request)
    {
        //validate the request
        $this->validate($request, [
            'tipo_resgistro' => 'required',
            'descripcion' => 'required'
        ]);

        //create a new registro
        $registro = new Registro;

        //set the attributes
        $registro->tipo_resgistro = $request->input('tipo_resgistro');
        $registro->descripcion = $request->input('descripcion');

        //save the registro
        $registro->save();

        //return a message
        return response()->json([
            'message' => 'Registro creado correctamente'
        ], 200);
    }

    //create a public function called show
    public function show($id)
    {
        //return registro from the database
        if(empty($registro)){
            return response()->json([
                'messge' => 'No hay registros'
            ], 404);
        }else{
            return response()->json([
                'data' => $registro = Registro::find($id)
            ], 200);
        }
    }

    //create a public function called update
    public function update(Request $request, $id)
    {
        //validate the request
        $this->validate($request, [
            'tipo_registro' => 'required',
            'descripcion' => 'required'
        ]);

        //find the registro
        $registro = Registro::find($id);

        if ($registro){
            $registro->tipo_registro = $request->input('tipo_registro');
            $registro->descripcion = $request->input('descripcion');
            //save the registro
            $registro->save();
            return response()->json([
                'error' => false,
                'message' => 'Se actulizo el registro correctamente',
                'data' => $registro
            ], 201);
            
        }else {
            return response()->json([
                'error' => true,
                'message' => 'No se pudo actulizar el registro',
                'data' => $registro
            ], 404);
        }
        //set the attributes

        //return a message
        return response()->json([
            'message' => 'Registro actualizado correctamente'
        ], 200);
    }

    //create a public function called destroy
    public function destroy($id)
    {
        //find the registro
        $registro = Registro::find($id);

        //delete the registro
        $registro->delete();

        //return a message
        return response()->json([
            'message' => 'Registro eliminado correctamente',
            'data' => $registro
        ], 200);
    }
}
