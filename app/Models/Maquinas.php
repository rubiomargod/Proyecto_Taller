<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maquinas extends Model
{
  protected $fillable = [
    'marca',
    'modelo',
    'numero_serie',
    'descripcion',
  ];
}
