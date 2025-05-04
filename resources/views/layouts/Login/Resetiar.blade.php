@extends('Guest')

@section('title', 'Restablecer Contraseña')

@section('body')

<style>
  /* Define tus variables de color personalizadas */
  :root {
    --ColorP: #3F485B;
    /* Color Primario (usado para botones primarios) */
    --ColorS: #FA6C17;
    /* Color Secundario (usado para fondos de headers y botones) */
    --ColorT: #879AB5;
    /* Color Terciario (usado para fondos de tarjetas y botones secundarios) */
    --TextoN: #000000;
    /* Texto Negro */
    --TextoB: white;
    /* Texto Blanco (Color de texto para backgrounds oscuros/botones) */
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

  .text-color-p {
    color: var(--ColorP);
  }

  /* Clase personalizada para el botón principal usando ColorP (no usada en el botón de envío aquí) */
  .btn-custom-primary {
    background-color: var(--ColorP);
    border-color: var(--ColorP);
    color: var(--TextoB);
  }

  .btn-custom-primary:hover {
    background-color: darken(var(--ColorP), 5%);
    border-color: darken(var(--ColorP), 5%);
    color: var(--TextoB);
  }

  .btn-custom-primary:focus {
    box-shadow: 0 0 0 0.25rem rgba(var(--ColorP), 0.25);
  }

  .btn-custom-primary:active {
    background-color: darken(var(--ColorP), 10%);
    border-color: darken(var(--ColorP), 10%);
  }

  /* Clases personalizadas para botones Outline (no usadas en este formulario) */
  /*
    .btn-outline-color-p { ... }
    .btn-outline-color-t { ... }
    */
</style>

{{-- Contenedor principal con margen superior e inferior --}}
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    {{-- Columna para limitar el ancho de la tarjeta --}}
    <div class="col-md-8 col-lg-6">
      {{-- Tarjeta con sombra, sin borde, esquinas redondeadas, color terciario de fondo y texto claro --}}
      <div class="card shadow-lg border-0 rounded-lg bg-color-t text-light"> {{-- Usando bg-color-t y text-light --}}

        {{-- Encabezado de la tarjeta con flex para alinear elementos, color secundario y texto negro --}}
        <div class="card-header d-flex align-items-center bg-color-s text-color-n"> {{-- Usando bg-color-s y text-color-n --}}
          {{-- Botón para Volver (enlace con estilo de botón pequeño y contorno oscuro) --}}
          {{-- Usamos btn-outline-dark como en la referencia del Login --}}
          <a href="{{ url('/') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left"></i> {{ __('Volver') }}
          </a>

          {{-- Título centrado que ocupa el espacio restante --}}
          <div class="flex-grow-1 text-center">
            {{-- Título con negrita y sin margen vertical --}}
            <h3 class="fw-bold my-0">{{ __('Restablecer Contraseña') }}</h3>
          </div>

          {{-- Opcional: Un div vacío o un botón invisible si necesitas un balance visual perfecto --}}
          {{-- <button class="btn btn-outline-dark btn-sm invisible"><i class="bi bi-arrow-left"></i> {{ __('Volver') }}</button> --}}

        </div> {{-- Fin del card-header --}}

        <div class="card-body">

          {{-- Mensaje de estado (ej: si el token es inválido) --}}
          {{-- El alert de éxito sigue siendo verde estándar de Bootstrap --}}
          @if (session('status'))
          <div class="alert alert-success mb-3" role="alert">
            {{ session('status') }}
          </div>
          @endif

          {{-- Formulario de restablecimiento de contraseña --}}
          <form method="POST" action="{{ route('password.store') }}">
            @csrf

            {{-- Token de restablecimiento (campo oculto) --}}
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            {{-- Campo de Correo electrónico --}}
            <div class="mb-3"> {{-- Espaciado inferior estándar --}}
              {{-- Label con icono dentro, usando form-label --}}
              <label for="email" class="form-label"><i class="bi bi-envelope me-2"></i> {{ __('Correo electrónico') }}</label>
              {{-- Input con form-control y validación de Bootstrap --}}
              <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', request()->email) }}"
                required
                autofocus
                class="form-control @error('email') is-invalid @enderror">
              {{-- Mensaje de error de Bootstrap --}}
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            {{-- Campo de Nueva contraseña --}}
            <div class="mb-3"> {{-- Espaciado inferior estándar --}}
              {{-- Label con icono dentro, usando form-label --}}
              <label for="password" class="form-label"><i class="bi bi-lock me-2"></i> {{ __('Nueva contraseña') }}</label>
              {{-- Input con form-control y validación de Bootstrap --}}
              <input
                id="password"
                type="password"
                name="password"
                required
                class="form-control @error('password') is-invalid @enderror">
              {{-- Mensaje de error de Bootstrap --}}
              @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            {{-- Campo de Confirmar contraseña --}}
            <div class="mb-3"> {{-- Espaciado inferior estándar --}}
              {{-- Label con icono dentro, usando form-label --}}
              <label for="password_confirmation" class="form-label"><i class="bi bi-lock me-2"></i> {{ __('Confirmar contraseña') }}</label>
              {{-- Input con form-control y validación de Bootstrap --}}
              <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                class="form-control @error('password_confirmation') is-invalid @enderror">
              {{-- Mensaje de error de Bootstrap --}}
              @error('password_confirmation')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            {{-- Contenedor del botón --}}
            {{-- Usando flex para alinear a la derecha, con margen superior --}}
            <div class="d-flex justify-content-end mt-4">
              {{-- Botón de envío --}}
              {{-- Usamos btn bg-color-s text-color-n para imitar el estilo del botón del Login en la referencia --}}
              <button type="submit" class="btn bg-color-s text-color-n">
                <i class="bi bi-arrow-clockwise me-2"></i> {{ __('Restablecer contraseña') }}
              </button>
            </div>
          </form>

        </div> {{-- Fin del card-body --}}

        {{-- Opcional: Pie de tarjeta (si necesitas un enlace de registro, por ejemplo) --}}
        {{-- Puedes adaptar el pie de la referencia del Login si aplica --}}
        {{--
                <div class="card-footer text-center py-3 bg-secondary border-top border-dark">
                      <div class="small"><a href="{{ route('register') }}" class="text-light text-decoration-none">¿No tienes cuenta? Regístrate</a>
      </div>
    </div>
    --}}

  </div> {{-- Fin del card --}}
</div> {{-- Fin del col --}}
</div> {{-- Fin del row --}}
</div> {{-- Fin del container --}}

@endsection