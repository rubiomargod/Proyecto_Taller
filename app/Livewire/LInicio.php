<?php

namespace App\Livewire;

use App\Models\Mantenimientos;
use Livewire\Component;
use Carbon\Carbon;

class LInicio extends Component
{
  public $proximos, $mantenimientosProximoMes, $mantenimientosUltimoMes, $totalEsteMes, $totalProximoMes, $costoEsteMes;
  public function render()
  {
    // 👉 Mantenimientos realizados en el último mes
    $inicioUltimoMes = Carbon::now()->subMonth()->startOfMonth();
    $finUltimoMes = Carbon::now()->subMonth()->endOfMonth();

    $this->mantenimientosUltimoMes = Mantenimientos::whereBetween('fecha_mantenimiento', [$inicioUltimoMes, $finUltimoMes])
      ->selectRaw('DATE(fecha_mantenimiento) as dia, COUNT(*) as total')
      ->groupBy('dia')
      ->orderBy('dia')
      ->pluck('total', 'dia')
      ->mapWithKeys(fn($total, $dia) => [Carbon::parse($dia)->format('d/m') => $total]);

    // 👉 Mantenimientos programados para el próximo mes
    $inicioProxMes = Carbon::now()->addMonth()->startOfMonth();
    $finProxMes = Carbon::now()->addMonth()->endOfMonth();

    $this->mantenimientosProximoMes = Mantenimientos::whereBetween('fecha_mantenimiento', [$inicioProxMes, $finProxMes])
      ->selectRaw('DATE(fecha_mantenimiento) as dia, COUNT(*) as total')
      ->groupBy('dia')
      ->orderBy('dia')
      ->pluck('total', 'dia')
      ->mapWithKeys(fn($total, $dia) => [Carbon::parse($dia)->format('d/m') => $total]);

    $this->proximos = Mantenimientos::with(['maquina', 'mecanico'])
      ->where('fecha_mantenimiento', '>=', now())
      ->orderBy('fecha_mantenimiento')
      ->take(10)
      ->get();


    $this->totalEsteMes = Mantenimientos::whereMonth('fecha_mantenimiento', now()->month)->count();
    $this->totalProximoMes = Mantenimientos::whereBetween('fecha_mantenimiento', [now()->addMonth()->startOfMonth(), now()->addMonth()->endOfMonth()])->count();
    $this->costoEsteMes = Mantenimientos::whereMonth('fecha_mantenimiento', now()->month)->sum('costo_total');

    return view('livewire.l-inicio');
  }
}
