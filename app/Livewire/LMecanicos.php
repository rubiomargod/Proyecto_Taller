<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Mecanicos;
use Livewire\WithPagination;

class LMecanicos extends Component
{
  use WithPagination;
  public $idMecanicoSeleccionado, $nombres, $apellidos, $correo, $telefono, $direccion, $ine, $estatus, $search, $contenido, $accion;
  public $Mecanicos = [];
  protected $rules = [
    'nombres' => 'required|string|max:255',
    'apellidos' => 'required|string|max:255',
    'correo' => 'required|email|unique:mecanicos,correo',
    'telefono' => 'required',
    'direccion' => 'required',
    'ine' => 'required|string|max:255',
    'estatus' => 'required',
  ];
  public function render()
  {
    return view('livewire.l-mecanicos');
  }
  public function Buscar()
  {
    $this->contenido = 'Mostrar';
    $this->Mecanicos = DB::table('mecanicos')
      ->where('nombres', 'like', '%' . $this->search . '%')
      ->get();
  }
  public function AbrirNuevo()
  {
    $this->accion = "Guardar";
    $this->dispatch('AbrirNuevoMecanico');
  }
  public function CerrarNuevo()
  {
    $this->accion = "";
    $this->reset();
    $this->dispatch('CerrarNuevoMecanico');
  }
  public function Guardar()
  {
    $this->validate();
    Mecanicos::create([
      'nombres' => $this->nombres,
      'apellidos' => $this->apellidos,
      'correo' => $this->correo,
      'telefono' => $this->telefono,
      'direccion' => $this->direccion,
      'ine' => $this->ine,
      'estatus' => $this->estatus,
    ]);
    $this->reset();
    //return redirect()->route('MECANICOS')->with('error', 'Ocurrió un error al guardar el mecánico.');
    $this->dispatch('CerrarNuevoMecanico');
    $this->dispatch('AbrirMensaje');
    return redirect()->route('MECANICOS')->with('success', 'Mecanico Guardado Corectamente');
  }
  public function AbrirEditar($IDMecanico)
  {
    $mecanico = Mecanicos::findOrFail($IDMecanico);
    $this->idMecanicoSeleccionado = $mecanico->id;
    $this->nombres = $mecanico->nombres;
    $this->apellidos = $mecanico->apellidos;
    $this->correo = $mecanico->correo;
    $this->telefono = $mecanico->telefono;
    $this->direccion = $mecanico->direccion;
    $this->ine = $mecanico->ine;
    $this->estatus = $mecanico->estatus;
    $this->accion = "Editar";
    $this->dispatch('AbrirNuevoMecanico');
  }
  public function CerrarEditar()
  {
    $this->accion = "";
    $this->reset();
    $this->dispatch('CerrarNuevoMecanico');
  }
  public function Editar()
  {
    $this->validate([
      'nombres' => 'required|string|max:255',
      'apellidos' => 'required|string|max:255',
      'correo' => 'required|email|unique:mecanicos,correo,' . $this->idMecanicoSeleccionado . ',id',
      'telefono' => 'required',
      'direccion' => 'required',
      'ine' => 'required|string|max:255',
      'estatus' => 'required',
    ]);

    $mecanico = Mecanicos::findOrFail($this->idMecanicoSeleccionado);

    $mecanico->update([
      'nombres' => $this->nombres,
      'apellidos' => $this->apellidos,
      'correo' => $this->correo,
      'telefono' => $this->telefono,
      'direccion' => $this->direccion,
      'ine' => $this->ine,
      'estatus' => $this->estatus,
    ]);

    $this->reset();
    $this->dispatch('CerrarNuevoMecanico');
    return redirect()->route('MECANICOS')->with('success', 'Mecánico actualizado correctamente');
  }

  public function AbrirBorrar($IDMecanico)
  {
    $mecanico = Mecanicos::findOrFail($IDMecanico);
    $this->idMecanicoSeleccionado = $mecanico->id;
    $this->nombres = $mecanico->nombres;
    $this->apellidos = $mecanico->apellidos;
    $this->correo = $mecanico->correo;
    $this->telefono = $mecanico->telefono;
    $this->direccion = $mecanico->direccion;
    $this->ine = $mecanico->ine;
    $this->estatus = $mecanico->estatus;
    $this->dispatch('AbrirBorrar');
  }
  public function CerrarBorrar()
  {
    $this->reset();
    $this->dispatch('CerrarBorrar');
    return redirect()->route('MECANICOS')->with('success', 'Cancelado Correctamente');
  }
  public function Eliminar($IDMecanico)
  {
    Mecanicos::destroy($IDMecanico);
    $this->reset();
    $this->dispatch('CerrarBorrar');
    return redirect()->route('MECANICOS')->with('success', 'Mecánico eliminado correctamente');
  }
}
