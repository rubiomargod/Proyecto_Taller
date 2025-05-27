<?php

namespace App\Livewire;

use App\Models\Piezas;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LPiezas extends Component
{
  public $Search, $Contenido, $Piezas, $Accion, $IDPieza, $nombre, $codigo, $descripcion, $cantidad, $precio_unitario, $marca;

  public function render()
  {
    return view('livewire.l-piezas');
  }

  public function Buscar()
  {
    $this->Contenido = 'Mostrar';
    $this->Piezas = DB::table('Piezas')
      ->where('nombre', 'like', '%' . $this->Search . '%')
      ->orWhere('codigo', 'like', '%' . $this->Search . '%')
      ->orWhere('marca', 'like', '%' . $this->Search . '%')
      ->get();
  }
  public function AbrirNueva()
  {
    $this->Accion = "Guardar";
    $this->dispatch('AbrirNuevaPieza');
  }
  public function CerrarNuevaPieza()
  {
    $this->Accion = "";
    $this->reset();
    $this->dispatch('CerrarNuevaPieza');
  }
  public function Guardar()
  {
    $this->validate([
      'nombre'          => 'required|string|max:255',
      'codigo'          => 'required|string|max:255|unique:piezas,codigo',
      'descripcion'     => 'nullable|string',
      'cantidad'        => 'required|integer|min:0',
      'precio_unitario' => 'required|numeric|min:0',
      'marca'           => 'required|string|max:255',
    ]);

    Piezas::create([
      'nombre'          => $this->nombre,
      'codigo'          => $this->codigo,
      'descripcion'     => $this->descripcion,
      'cantidad'        => $this->cantidad,
      'precio_unitario' => $this->precio_unitario,
      'marca'           => $this->marca,
    ]);

    $this->reset(['nombre', 'codigo', 'descripcion', 'cantidad', 'precio_unitario', 'marca']);
    return redirect()->route('PIEZAS')->with('success', 'Piezas registrada correctamente.');
  }
  public function AbrirEditar($ID)
  {
    $pieza = Piezas::findOrFail($ID);

    $this->IDPieza     = $pieza->id;
    $this->nombre           = $pieza->nombre;
    $this->codigo           = $pieza->codigo;
    $this->descripcion      = $pieza->descripcion;
    $this->cantidad         = $pieza->cantidad;
    $this->precio_unitario  = $pieza->precio_unitario;
    $this->marca            = $pieza->marca;

    $this->Accion = "Editar";
    $this->dispatch('AbrirNuevaPieza');
  }
  public function Editar()
  {
    $this->validate([
      'nombre'          => 'required|string|max:255',
      'codigo'          => 'required|string|max:100|unique:piezas,codigo,' . $this->IDPieza,
      'descripcion'     => 'nullable|string',
      'cantidad'        => 'required|integer|min:0',
      'precio_unitario' => 'required|numeric|min:0',
      'marca'           => 'required|string|max:255',
    ]);

    $refaccion = Piezas::findOrFail($this->IDPieza);

    $refaccion->update([
      'nombre'          => $this->nombre,
      'codigo'          => $this->codigo,
      'descripcion'     => $this->descripcion,
      'cantidad'        => $this->cantidad,
      'precio_unitario' => $this->precio_unitario,
      'marca'           => $this->marca,
    ]);

    $this->reset();
    return redirect()->route('PIEZAS')->with('success', 'Refacción editada correctamente.');
  }
  public function AbrirBorrarPieza($id)
  {
    $refaccion = Piezas::findOrFail($id);

    $this->IDPieza = $refaccion->id;
    $this->nombre = $refaccion->nombre;
    $this->codigo = $refaccion->codigo;

    $this->dispatch('AbrirBorrarPieza');
  }
  public function CerrarBorrarPieza()
  {
    $this->reset();
    return redirect()->route('PIEZAS')->with('success', 'Cancelado Correctamente');
  }
  public function Eliminar($id)
  {
    $refaccion = Piezas::findOrFail($id);
    $refaccion->delete();
    return redirect()->route('PIEZAS')->with('success', 'Pieza eliminada correctamente');
  }
}
