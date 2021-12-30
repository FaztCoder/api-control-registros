<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [

        'nombre',
        'apellidos',
        'edad',
        'telefono_1',
        'telefono_2'
    ];
    
    public $timestamps = false;
}
