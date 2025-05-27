<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantenimientos extends Model
{
  protected $fillable = [
    'fk_id_mecanico',
    'fk_id_maquina',
    'fecha_mantenimiento',
    'tipo_mantenimiento',
    'costo_total',
  ];
  public function mecanico()
  {
    return $this->belongsTo(Mecanicos::class, 'fk_id_mecanico');
  }
  public function maquina()
  {
    return $this->belongsTo(Maquinas::class, 'fk_id_maquina');
  }
  public function detalles()
  {
    return $this->hasMany(Detalles::class, 'fk_id_mantenimiento');
  }
}
