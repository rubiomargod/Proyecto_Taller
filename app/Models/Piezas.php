<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piezas extends Model
{
  protected $fillable = [
    'nombre',
    'codigo',
    'descripcion',
    'cantidad',
    'precio_unitario',
    'marca',
  ];
}
