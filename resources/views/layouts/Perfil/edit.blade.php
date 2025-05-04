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
    /* Usar TextoB para el texto sobre ColorP */
  }

  .bg-color-t {
    background-color: var(--ColorT);
    color: var(--TextoB);
    /* Usar TextoB para el texto sobre ColorT */
  }

  .bg-color-s {
    background-color: var(--ColorS);
    color: var(--TextoN);
    /* Usar TextoN para el texto sobre ColorS */
  }

  .text-color-n {
    color: var(--TextoN);
    /* Usar TextoN para texto específico */
  }

  /* La clase btn-custom-primary no es necesaria en esta vista padre, solo en el formulario */
</style>
{{-- Contenedor principal para las tarjetas --}}
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">

      {{-- Tarjeta: Actualizar Información de Perfil --}}
      {{-- Usando clase personalizada bg-color-t para el color de la tarjeta y text-light para el texto --}}
      <div class="card mb-4 shadow-lg border-0 rounded-lg bg-color-t text-light">
        {{-- Encabezado de la tarjeta con color de acento (colorS) y texto negro (TextoN) --}}
        {{-- Usando clase personalizada bg-color-s y text-color-n --}}
        <div class="card-header d-flex align-items-center bg-color-s text-color-n">
          {{-- Icono de Perfil/Información --}}
          <i class="bi bi-person-circle h5 me-2 my-0"></i> {{-- Icono de persona con círculo, tamaño h5, margen derecho, sin margen vertical --}}

          {{-- Título centrado que ocupa el espacio restante --}}
          <h5 class="fw-bold my-0 flex-grow-1 text-center">{{ __('Información del Perfil') }}</h5> {{-- Usando __() --}}
          {{-- Espacio para balance si es necesario (ya no necesario con flex y grow) --}}
          {{-- <div style="width: 24px;"></div> --}}

        </div>
        <div class="card-body">
          {{-- Aquí se incluirá el contenido del formulario de actualización de perfil --}}
          {{-- RECUERDA: El contenido de 'Layouts.Perfil.update-profile-information-form'
NECESITA usar las clases de texto adecuadas (text-color-n o text-light según sea necesario para los elementos internos sobre el fondo bg-color-t). Ya convertimos este formulario en la respuesta anterior. --}}
          @include('Layouts.Perfil.update-profile-information-form')
        </div>
      </div>

      {{-- Tarjeta: Actualizar Contraseña --}}
      {{-- Usando clase personalizada bg-color-t para el color de la tarjeta y text-light para el texto --}}
      <div class="card mb-4 shadow-lg border-0 rounded-lg bg-color-t text-light">
        {{-- Encabezado de la tarjeta con color de acento (colorS) y texto negro (TextoN) --}}
        {{-- Usando clase personalizada bg-color-s y text-color-n --}}
        <div class="card-header d-flex align-items-center bg-color-s text-color-n">
          {{-- Icono de Candado/Contraseña --}}
          <i class="bi bi-lock h5 me-2 my-0"></i> {{-- Icono de candado, tamaño h5, margen derecho, sin margen vertical --}}

          {{-- Título centrado --}}
          <h5 class="fw-bold my-0 flex-grow-1 text-center">{{ __('Actualizar Contraseña') }}</h5> {{-- Usando __() --}}
          {{-- Espacio para balance si es necesario (ya no necesario con flex y grow) --}}
          {{-- <div style="width: 24px;"></div> --}}

        </div>
        <div class="card-body">
          {{-- Aquí se incluirá el contenido del formulario de actualización de contraseña --}}
          {{-- RECUERDA: El contenido de 'Layouts.Perfil.update-password-form'
NECESITA usar las clases de texto adecuadas (text-color-n o text-light según sea necesario para los elementos internos sobre el fondo bg-color-t). --}}
          @include('Layouts.Perfil.update-password-form')
        </div>
      </div>

      {{-- Tarjeta: Eliminar Cuenta --}}
      {{-- Usando clase personalizada bg-color-t para el color de la tarjeta y text-light para el texto --}}
      <div class="card mb-4 shadow-lg border-0 rounded-lg bg-color-t text-light">
        {{-- Encabezado de la tarjeta con color de peligro (danger) y texto claro (TextoB / white) --}}
        {{-- Usamos bg-danger (rojo) que por defecto tiene texto blanco, que coincide con TextoB --}}
        <div class="card-header d-flex align-items-center bg-danger text-white"> {{-- Mantenemos bg-danger por ser estándar para eliminar --}}
          {{-- Icono de Eliminar/Advertencia --}}
          <i class="bi bi-exclamation-triangle-fill h5 me-2 my-0"></i> {{-- Icono de triángulo de advertencia, tamaño h5, margen derecho, sin margen vertical --}}
          {{-- Título centrado --}}
          <h5 class="fw-bold my-0 flex-grow-1 text-center">{{ __('Eliminar Cuenta') }}</h5> {{-- Usando __() --}}
          {{-- Espacio para balance si es necesario (ya no necesario con flex y grow) --}}
          {{-- <div style="width: 24px;"></div> --}}

        </div>
        <div class="card-body">
          {{-- Aquí se incluirá el contenido del formulario de eliminación de cuenta --}}
          {{-- RECUERDA: El contenido de 'Layouts.Perfil.delete-user-form'
NECESITA usar las clases de texto adecuadas (text-color-n o text-light según sea necesario para los elementos internos sobre el fondo bg-color-t). Ya convertimos este formulario en una respuesta anterior. --}}
          @include('Layouts.Perfil.delete-user-form')
        </div>
      </div>

    </div> {{-- Fin col --}}
    {{-- Aquí se podría incluir la tarjeta para la sesión de navegador si la necesitas --}}
  </div> {{-- Fin row --}}
</div> {{-- Fin container --}}
@endsection