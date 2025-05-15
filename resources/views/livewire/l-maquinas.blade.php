<div>
  @include('Components.MSG')
  @include('layouts.Maquinas.Buscador')
  @include('layouts.Maquinas.FRMNueva')
  @include('layouts.Maquinas.FRMBorrar')
  @if($Contenido == 'Mostrar')
  @include('layouts.Maquinas.DTGMaquinas')
  @endif
</div>