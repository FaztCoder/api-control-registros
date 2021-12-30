<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;

    protected $fillable  = [
        'nombre_taller',
        'descripcion',
        'hora_inicio',
        'hora_fin',
        // 'registro_id'
    ];

    protected $table = 'talleres';
}
