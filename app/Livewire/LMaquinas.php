<?php

namespace App\Livewire;

use App\Models\Maquinas;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LMaquinas extends Component
{
  public $Maquinas = [];
  public $Contenido, $Search, $Accion, $marca, $modelo, $numero_serie, $descripcion, $maquina_id;
  public function render()
  {
    return view('livewire.l-maquinas');
  }
  public function Buscar()
  {
    $this->Contenido = 'Mostrar';
    $this->Maquinas = DB::table('maquinas')
      ->where('marca', 'like', '%' . $this->Search . '%')
      ->orWhere('modelo', 'like', '%' . $this->Search . '%')
      ->orWhere('numero_serie', 'like', '%' . $this->Search . '%')
      ->get();
  }
  public function AbrirNueva()
  {
    $this->Accion = "Guardar";
    $this->dispatch('AbrirNuevaMaquina');
  }
  public function CerrarNueva()
  {
    $this->Accion = "";
    $this->reset();
    $this->dispatch('CerrarNuevaMaquina');
  }
  public function Guardar()
  {
    $this->validate([
      'marca' => 'required|string|max:255',
      'modelo' => 'required|string|max:255',
      'numero_serie' => 'required|string|max:255|unique:maquinas,numero_serie',
      'descripcion' => 'nullable|string',
    ]);

    Maquinas::create([
      'marca' => $this->marca,
      'modelo' => $this->modelo,
      'numero_serie' => $this->numero_serie,
      'descripcion' => $this->descripcion,
    ]);

    $this->reset(['marca', 'modelo', 'numero_serie', 'descripcion']);
    $this->dispatch('AbrirMensaje');
    return redirect()->route('MAQUINAS')->with('success', 'Maquina Guardada Corectamente');
  }
  public function AbrirEditar($IDMaquina)
  {
    $maquina = Maquinas::findOrFail($IDMaquina);

    $this->maquina_id = $maquina->id;
    $this->marca = $maquina->marca;
    $this->modelo = $maquina->modelo;
    $this->numero_serie = $maquina->numero_serie;
    $this->descripcion = $maquina->descripcion;

    $this->Accion = "Editar";
    $this->dispatch('AbrirNuevaMaquina');
  }
  public function Editar()
  {
    $this->validate([
      'marca' => 'required|string|max:255',
      'modelo' => 'required|string|max:255',
      'numero_serie' => 'required|string|max:255|unique:maquinas,numero_serie,' . $this->maquina_id,
      'descripcion' => 'nullable|string',
    ]);

    $maquina = Maquinas::findOrFail($this->maquina_id);

    $maquina->update([
      'marca' => $this->marca,
      'modelo' => $this->modelo,
      'numero_serie' => $this->numero_serie,
      'descripcion' => $this->descripcion,
    ]);

    $this->reset();
    $this->dispatch('AbrirMensaje');
    return redirect()->route('MAQUINAS')->with('success', 'Maquina Editada Corectamente');
  }
  public function AbrirBorrar($id)
  {
    $maquina = Maquinas::findOrFail($id);

    $this->maquina_id = $maquina->id;
    $this->marca = $maquina->marca;
    $this->modelo = $maquina->modelo;
    $this->numero_serie = $maquina->numero_serie;

    $this->dispatch('AbrirBorrarMaquina');
  }
  public function EliminarMaquina($id)
  {
    $maquina = Maquinas::findOrFail($id);
    $maquina->delete();
    $this->dispatch('CerrarBorrarMaquina');
    return redirect()->route('MAQUINAS')->with('success', 'Maquina Eliminada Corectamente');
  }
  public function CerrarBorrarMaquina()
  {
    $this->reset(['maquina_id', 'marca', 'modelo', 'numero_serie']);
    $this->dispatch('CerrarBorrarMaquina');
    return redirect()->route('MAQUINAS')->with('success', 'Cancelado Corectamente');
  }
}
