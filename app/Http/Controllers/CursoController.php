<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
     //crea una funcion publica index
     public function index() {
        $curso = Curso::all();
        if (count($curso) > 0) {
            return response()->json([
                'error' => false,
                'message' => 'Se encontraron cursos registrados',
                'data' => $curso
            ], 200);
        }else {
            return response()->json([
                'error' => true,
                'message' => 'No se encontraron cursos registrados',
                'data' => $curso
            ], 404);
        }
    }

    public function store(Request $request) {
        $curso = Curso::create($request->all());

        if ($curso) {
            $validateData = $request->validate([
                'nombre_curso' => 'required | max: 255',
                'descripcion' => 'required | max: 255',
            ]);
        }
        if ($validateData) {
            return response()->json([
                'error' => false,
                'message' => 'Se creo correctamente el curso',
                'data' => $curso
            ], 201);
        }else {
            return response()->json([
                'error' => true,
                'message' => 'No se pudo crear el curso',
                'data' => $curso
            ], 500);
        }
    }

    public function show ($id) {
        $curso = Curso::find($id);

        if(empty($curso)) {
            return response()->json([
                'error' => true,
                'message' => 'No se pudo encontrar el curso',
                'data' => $curso
            ], 404);
        }else {
            return response()->json([
                'error' => false,
                'message' => 'Curso encontrado',
                'data' => $curso
            ], 200);
        }
    }

    public function update (Request $request, $id) {
        $curso = Curso::find($id);

        if(empty($curso)){
            return response()->json([
                'error' => true,
                'message' => 'No se pudo actualizar el curso',
                'data' => $curso
            ], 404);
        }else {
            $curso->update($request->all());
            return response()->json([
                'error' => false,
                'message' => 'Se actualizó el curso',
                'data' => $curso
            ], 200);
        }
    }

    public function destroy($id) {
        $curso = Curso::find($id);

        if($curso) {
            $curso->delete();
            return response()->json([
                'error' =>false,
                'message' => 'Se elimino el curso correctamente',
                'data' => $curso
            ], 200);
        }else {
            return response()->json([
                'error' =>true,
                'message' => 'No se pudo eliminar el curso',
                'data' => $curso
            ], 404);
        }
    }
}
