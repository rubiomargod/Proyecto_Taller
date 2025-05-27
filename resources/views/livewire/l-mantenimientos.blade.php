<div>
  @include('Components.MSG')
  @include('layouts.Mantenimientos.Buscador')
  @if($Contenido == 'Mostrar')
  @include('layouts.Mantenimientos.DTGMantenimientos')
  @endif
  @include('layouts.Mantenimientos.FRMNuevo')
  @include('layouts.Mantenimientos.FRMBorrar')
  @include('layouts.Mantenimientos.FRMDetalles')
</div>