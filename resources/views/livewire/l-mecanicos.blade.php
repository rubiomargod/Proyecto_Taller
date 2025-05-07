<div>
  @include('Components.MSG')
  @include('layouts.Mecanicos.Buscador')
  @include('layouts.Mecanicos.FRMNuevo')
  @include('layouts.Mecanicos.FRMBorrar')
  @if($contenido == 'Mostrar')
  @include('layouts.Mecanicos.DTGMecanicos')
  @endif
</div>