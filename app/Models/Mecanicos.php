<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mecanicos extends Model
{
  protected $fillable = [
    'nombres',
    'apellidos',
    'correo',
    'telefono',
    'direccion',
    'ine',
    'estatus',
  ];
}
