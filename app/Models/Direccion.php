<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    // FORZAMOS el nombre de la tabla para que no busque "direccions"
    protected $table = 'direcciones'; 

    protected $fillable = [
        'nombre', 
        'apellido', 
        'telefono', 
        'correo', 
        'direccion'
    ];
}