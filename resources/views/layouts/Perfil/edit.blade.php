@extends('App')
@section('title','Perfil')

@section('body')
<style>
  /* Define tus variables de color personalizadas */
  :root {
    --ColorP: #3F485B;
    /* Color Primario (Header Background) */
    --ColorS: #FA6C17;
    /* Color Secundario (Card Header Background para Info/Password) */
    --ColorT: #879AB5;
    /* Color Terciario (Card Background) */
    --TextoN: #000000;
    /* Texto Negro (Color de texto para headers con --ColorS) */
    --TextoB: white;
    /* Texto Blanco (Color de texto para backgrounds oscuros) */
  }

  /* Clases personalizadas para aplicar tus colores */
  .bg-color-p {
    background-color: var(--ColorP);
    color: var(--TextoB);
  }

  .bg-color-t {
    background-color: var(--ColorT);
    color: var(--TextoB);
  }

  .bg-color-s {
    background-color: var(--ColorS);
    color: var(--TextoN);
  }

  .text-color-n {
    color: var(--TextoN);
  }

  /* La clase btn-custom-primary no es necesaria en esta vista padre, solo en el formulario */
</style>

{{-- Encabezado de la página - Título "Perfil" --}}
{{-- Usando clase personalizada bg-color-p, texto claro, padding y centrado --}}
<div class="bg-color-p text-light py-4 text-center">
  <div class="container">
    {{-- Título de la página --}}
    <h1 class="h4 my-0">{{ __('Perfil') }}</h1>
  </div>
</div>

{{-- Contenedor principal para las tarjetas --}}
{{-- Este div ahora sigue al encabezado de la página --}}
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">

      {{-- Tarjeta: Actualizar Información de Perfil --}}
      <div class="card mb-4 shadow-lg border-0 rounded-lg bg-color-t text-light">
        <div class="card-header d-flex align-items-center bg-color-s text-color-n">
          <i class="bi bi-person-circle h5 me-2 my-0"></i>
          <h5 class="fw-bold my-0 flex-grow-1 text-center">{{ __('Información del Perfil') }}</h5>
          {{-- Comentarios de espacio eliminados para brevedad --}}
        </div>
        <div class="card-body">
          {{-- Contenido del formulario de actualización de perfil --}}
          {{-- Asumimos que el contenido de este include ya fue convertido --}}
          @include('Layouts.Perfil.update-profile-information-form')
        </div>
      </div>

      {{-- Tarjeta: Actualizar Contraseña --}}
      <div class="card mb-4 shadow-lg border-0 rounded-lg bg-color-t text-light">
        <div class="card-header d-flex align-items-center bg-color-s text-color-n">
          <i class="bi bi-lock h5 me-2 my-0"></i>
          <h5 class="fw-bold my-0 flex-grow-1 text-center">{{ __('Actualizar Contraseña') }}</h5>
          {{-- Comentarios de espacio eliminados --}}
        </div>
        <div class="card-body">
          {{-- Contenido del formulario de actualización de contraseña --}}
          {{-- Asumimos que el contenido de este include ya fue convertido --}}
          @include('Layouts.Perfil.update-password-form')
        </div>
      </div>

      {{-- Tarjeta: Eliminar Cuenta --}}
      <div class="card mb-4 shadow-lg border-0 rounded-lg bg-color-t text-light">
        <div class="card-header d-flex align-items-center bg-danger text-white">
          <i class="bi bi-exclamation-triangle-fill h5 me-2 my-0"></i>
          <h5 class="fw-bold my-0 flex-grow-1 text-center">{{ __('Eliminar Cuenta') }}</h5>
          {{-- Comentarios de espacio eliminados --}}
        </div>
        <div class="card-body">
          {{-- Contenido de la sección Eliminar Cuenta (incluye el modal) --}}
          {{-- Asumimos que el contenido de este include ya fue convertido --}}
          @include('Layouts.Perfil.delete-user-form')
        </div>
      </div>

    </div> {{-- Fin col --}}
    {{-- Aquí se podría incluir la tarjeta para la sesión de navegador si la necesitas --}}
  </div> {{-- Fin row --}}
</div> {{-- Fin container --}}

@endsection