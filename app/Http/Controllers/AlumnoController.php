<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Http\Resources\Alumno\AlumnoResource;
use App\Http\Resources\Alumno\AlumnoCollection;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumno = Alumno::all();
        if (count($alumno) > 0) {
            return response()->json([
                'error' => false,
                'message' => 'Se encontraron alumnos registrados',
                'data' => $alumno
            ], 200);
        }else {
            return response()->json([
                'error' => true,
                'message' => 'No se encontraron alumnos registrados',
                'data' => $alumno
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alumno = Alumno::create($request->all());
        if($alumno) {
            $validateData = $request->validate([
                'nombre' => 'required | max:50',
                'apellidos' => 'required | max:200',
                'edad' => 'required | numeric',
                'telefono_1' => 'required | max:13',
                'telefono_2' => 'required | max:13',
            ]);
            if($validateData){
                return new AlumnoResource($alumno);
            }else {
                return response()->json([
                    'message' => 'No se pudo registar el alumno',
                    'data' => $alumno
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno = Alumno::find($id);
        if(empty($alumno)){
            return response()->json([
                "message" => "No se encontró el alumno",
                "error" => true
            ], 404);
        }else{
            return new AlumnoResource($alumno);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //create a update request
        $alumno = Alumno::find($id);
        
        if(empty($alumno)){
            return response()->json([
                "error" => true,
                "message" => "No se pudo actulizar el alumno"
            ], 404);
        }else{
            $alumno->update($request->all());
            return new AlumnoResource($alumno);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumno = Alumno::find($id);
        if ($alumno) {
            $alumno->delete();
            return new AlumnoResource($alumno);
        }else{
            return response()->json(['error' => 'No se encontro el alumno'], 404);
        }
    }
}
