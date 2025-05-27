<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalles extends Model
{
  use HasFactory;

  protected $fillable = [
    'fk_id_mantenimiento',
    'fk_id_pieza',
    'detalle',
    'costo',
  ];

  public function pieza()
  {
    return $this->belongsTo(Piezas::class, 'fk_id_pieza');
  }
  public function mantenimiento()
  {
    return $this->belongsTo(Mantenimientos::class, 'fk_id_mantenimiento');
  }
  public function detalles()
  {
    return $this->hasMany(Detalles::class, 'fk_id_mantenimiento');
  }
}
