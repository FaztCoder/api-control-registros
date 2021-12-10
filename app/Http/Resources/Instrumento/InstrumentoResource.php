<?php

namespace App\Http\Resources\Instrumento;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class InstrumentoResource extends JsonResource
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
            'nombre' => Str::lower($this->nombre),
            'descripcion' => Str::lower($this->descripcion),
            'registro_id' => $this->registro_id,
            'creado_el' => $this->created_at->format('d/m/Y'),
            'actulizado_el' => $this->updated_at->format('d/m/Y')
        ];
    }
}
