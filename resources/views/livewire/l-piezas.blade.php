<div>
  @include('Components.MSG')
  @include('layouts.Piezas.Buscador')
  @include('layouts.Piezas.FRMNueva')
  @include('layouts.Piezas.FRMBorrar')
  @if($Contenido == 'Mostrar')
  @include('layouts.Piezas.DTGPiezas')
  @endif
</div>