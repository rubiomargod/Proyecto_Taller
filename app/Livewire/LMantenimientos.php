<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use App\Models\Mantenimientos;
use App\Models\Mecanicos;
use App\Models\Detalles;
use App\Models\Maquinas;
use App\Models\Piezas;
use Livewire\Component;

class LMantenimientos extends Component
{
  public $Search, $Contenido, $Accion, $FKIDPieza, $Detalle, $Subtotal, $mantenimiento_id, $fk_id_mecanico, $fk_id_maquina, $fecha_mantenimiento, $tipo_mantenimiento, $costo_total, $Mantenimiento, $Mecanicos = [], $Maquinas = [], $Detalles = [], $Mantenimientos = [], $Piezas = [];
  public function render()
  {
    return view('livewire.l-mantenimientos');
  }
  public function Buscar()
  {
    $this->Contenido = 'Mostrar';

    $this->Mantenimientos = Mantenimientos::with(['mecanico', 'maquina'])
      ->where(function ($query) {
        $query->where('tipo_mantenimiento', 'like', '%' . $this->Search . '%')
          ->orWhere('fecha_mantenimiento', 'like', '%' . $this->Search . '%')
          ->orWhere('costo_total', 'like', '%' . $this->Search . '%')
          ->orWhereHas('mecanico', function ($q) {
            $q->where('nombres', 'like', '%' . $this->Search . '%')
              ->orWhere('apellidos', 'like', '%' . $this->Search . '%');
          })
          ->orWhereHas('maquina', function ($q) {
            $q->where('modelo', 'like', '%' . $this->Search . '%')
              ->orWhere('marca', 'like', '%' . $this->Search . '%');
          });
      })
      ->get();
  }
  public function AbrirNuevoMantenimiento()
  {
    $this->Accion = "Guardar";
    $this->Mecanicos = Mecanicos::all();
    $this->Maquinas = Maquinas::all();
    $this->dispatch('AbrirNuevoMantenimiento');
  }
  public function AgregarDetalle()
  {
    $this->Detalles[] = ['fk_id_pieza' => '', 'detalle' => '', 'costo' => ''];
  }
  public function EliminarDetalle($index)
  {
    unset($this->Detalles[$index]);
    $this->Detalles = array_values($this->Detalles);
  }
  public function CerrarNuevoMantenimiento()
  {
    $this->reset();
    $this->dispatch('CerrarNuevoMantenimiento');
  }
  public function Guardar()
  {
    $this->validate([
      'fk_id_mecanico' => 'required|exists:mecanicos,id',
      'fk_id_maquina' => 'required|exists:maquinas,id',
      'fecha_mantenimiento' => 'required|date',
      'tipo_mantenimiento' => 'required|in:preventivo,correctivo,predictivo',
    ]);
    Mantenimientos::create([
      'fk_id_mecanico' => $this->fk_id_mecanico,
      'fk_id_maquina' => $this->fk_id_maquina,
      'fecha_mantenimiento' => $this->fecha_mantenimiento,
      'tipo_mantenimiento' => $this->tipo_mantenimiento,
      'costo_total' => 00.00,
    ]);
    $this->reset();
    $this->dispatch('AbrirMensaje');
    return redirect()->route('MANTENIMIENTOS')->with('success', 'Mantenimiento Porgramado Correctamente.');
  }
  public function AbrirEditarMantenimiento($ID)
  {
    $this->Accion = "Editar";
    $this->Mecanicos = Mecanicos::all();
    $this->Maquinas = Maquinas::all();
    $mantenimientos = Mantenimientos::with('detalles')->findOrFail($ID);
    $this->mantenimiento_id     = $mantenimientos->id;
    $this->fk_id_mecanico       = $mantenimientos->fk_id_mecanico;
    $this->fk_id_maquina        = $mantenimientos->fk_id_maquina;
    $this->fecha_mantenimiento  = $mantenimientos->fecha_mantenimiento;
    $this->tipo_mantenimiento   = $mantenimientos->tipo_mantenimiento;
    $this->costo_total          = $mantenimientos->costo_total;
    $this->dispatch('AbrirNuevoMantenimiento');
  }
  public function Editar()
  {
    $this->validate([
      'fk_id_mecanico' => 'required|exists:mecanicos,id',
      'fk_id_maquina' => 'required|exists:maquinas,id',
      'fecha_mantenimiento' => 'required|date',
      'tipo_mantenimiento' => 'required|string|max:255',
      'costo_total' => 'required|numeric|min:0',
    ]);

    $mantenimiento = Mantenimientos::findOrFail($this->mantenimiento_id);

    $mantenimiento->update([
      'fk_id_mecanico' => $this->fk_id_mecanico,
      'fk_id_maquina' => $this->fk_id_maquina,
      'fecha_mantenimiento' => $this->fecha_mantenimiento,
      'tipo_mantenimiento' => $this->tipo_mantenimiento,
      'costo_total' => $this->costo_total,
    ]);

    $this->reset();
    $this->dispatch('AbrirMensaje');
    return redirect()->route('MANTENIMIENTOS')->with('success', 'Mantenimiento editado correctamente');
  }
  public function AbrirBorrarMantenimiento($ID)
  {
    $this->Mantenimiento = Mantenimientos::with(['mecanico', 'maquina'])->findOrFail($ID);
    $this->mantenimiento_id = $ID;
    $this->dispatch('AbrirBorrarMantenimiento');
  }
  public function CerrarBorrarMantenimiento()
  {
    $this->reset();
    $this->dispatch('CerrarBorrarMantenimiento');
    return redirect()->route('MANTENIMIENTOS')->with('success', 'Cancelado Correctamente');
  }
  public function Eliminar()
  {
    $mantenimiento = Mantenimientos::findOrFail($this->mantenimiento_id);
    $mantenimiento->delete();
    return redirect()->route('MANTENIMIENTOS')->with('success', 'Mantenimiento y sus detalles eliminados correctamente');
  }
  public function AbrirDetallesMantenimiento($ID)
  {
    $this->Piezas = Piezas::all();
    $this->Mantenimiento = Mantenimientos::with(['mecanico', 'maquina', 'detalles'])->findOrFail($ID);
    $this->mantenimiento_id = $ID;
    $this->fecha_mantenimiento = $this->Mantenimiento->fecha_mantenimiento;
    $this->tipo_mantenimiento = $this->Mantenimiento->tipo_mantenimiento;
    $this->costo_total = $this->Mantenimiento->costo_total;
    $this->Detalles = $this->Mantenimiento->detalles->map(function ($detalle) {
      return [
        'fk_id_pieza' => $detalle->fk_id_pieza,
        'detalle' => $detalle->detalle,
        'costo' => $detalle->costo,
      ];
    })->toArray();
    $this->dispatch('AbrirDetallesMantenimiento');
  }
  public function CerrarDetallesMantenimiento()
  {
    $this->reset();
    $this->dispatch('CerrarDetallesMantenimiento');
  }
  public function GuardarDetalles()
  {
    $this->validate([
      'Detalles.*.fk_id_pieza' => 'required|exists:piezas,id',
      'Detalles.*.detalle' => 'required|string|max:255',
      'Detalles.*.costo' => 'required|numeric|min:0',
    ]);

    $idsGuardados = [];
    $totalCosto = 0;
    foreach ($this->Detalles as $detalle) {
      $totalCosto += floatval($detalle['costo']);
      if (isset($detalle['id'])) {
        // Actualizar el detalle existente
        $detalleExistente = Detalles::find($detalle['id']);
        if ($detalleExistente) {
          $detalleExistente->update([
            'fk_id_pieza' => $detalle['fk_id_pieza'],
            'detalle' => $detalle['detalle'],
            'costo' => $detalle['costo'],
          ]);
          $idsGuardados[] = $detalleExistente->id;
        }
      } else {
        // Crear nuevo detalle
        $nuevo = Detalles::create([
          'fk_id_mantenimiento' => $this->Mantenimiento->id,
          'fk_id_pieza' => $detalle['fk_id_pieza'],
          'detalle' => $detalle['detalle'],
          'costo' => $detalle['costo'],
        ]);
        $idsGuardados[] = $nuevo->id;
      }
    }
    Detalles::where('fk_id_mantenimiento', $this->Mantenimiento->id)
      ->whereNotIn('id', $idsGuardados)
      ->delete();
    $this->Mantenimiento->update([
      'costo_total' => $totalCosto,
    ]);
    $this->reset();
    return redirect()->route('MANTENIMIENTOS')->with('success', 'Guardar detalles');
  }
}
