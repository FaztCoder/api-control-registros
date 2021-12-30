<?php

namespace App\Http\Resources\Alumno;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumnoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => Str::lower($this->nombre),
            'apellidos' => mb_strtolower($this->apellidos, 'UTF-8'),
            'edad' => $this->edad,
            'telefono_1' => $this->telefono_1,
            'telefono_2' => $this->telefono_2,
        ];
    }

}
