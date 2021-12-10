<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;

    protected $fillable  = [
        'nombre',
        'descripcion',
        'horario_inicio',
        'horario_fin',
        'registro_id'
    ];

    protected $table = 'talleres';
}
