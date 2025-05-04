@extends('Guest')
@section('title','Login')
@section('body')
<x-auth-session-status class="mb-4" :status="session('status')" />
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    {{-- Columna un poco más pequeña ya que el formulario es simple --}}
    <div class="col-md-7 col-lg-5">
      {{-- Tarjeta en gris oscuro, con texto claro general --}}
      <div class="card shadow-lg border-0 rounded-lg bg-secondary text-light">

        {{-- Encabezado que es un flex container para alinear elementos --}}
        <div class="card-header d-flex align-items-center bg-warning text-dark">
          {{-- Botón para Volver (enlace con estilo de botón pequeño y contorno oscuro) --}}
          <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left"></i> Volver
          </a>

          {{-- Título centrado que ocupa el espacio restante --}}
          {{-- flex-grow-1 hace que este div ocupe todo el espacio disponible --}}
          <div class="flex-grow-1 text-center">
            <h3 class="fw-bold my-0">Restablecer Contraseña</h3> {{-- my-0 para evitar margen superior/inferior del h3 --}}
          </div>

          {{-- Opcional: Un div vacío si necesitas un balance visual perfecto a la derecha del título --}}
          {{-- <div style="width: 50px;"></div> --}}
          {{-- Otra opción: Un botón invisible si quieres que el título esté *exactamente* centrado --}}
          {{-- <button class="btn btn-outline-dark btn-sm invisible"><i class="bi bi-arrow-left"></i> Volver</button> --}}

        </div> {{-- Fin del card-header --}}


        <div class="card-body">

          {{-- Mensaje de introducción --}}
          <div class="mb-4 small"> {{-- small para texto un poco más pequeño, mb-4 para margen --}}
            ¿Olvidaste tu contraseña? No hay problema. Simplemente indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer la contraseña que te permitirá elegir una nueva.
          </div>

          @if (session('status'))
          <div class="alert alert-success mb-3" role="alert"> {{-- El alert de éxito sigue siendo verde --}}
            {{ session('status') }}
          </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
              {{-- Icono de Email --}}
              <label for="email" class="form-label"><i class="bi bi-envelope me-2"></i> Correo Electrónico</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            {{-- Contenedor para el botón Enviar, alineado a la derecha --}}
            <div class="d-flex justify-content-end mt-4">
              {{-- Botón para Enviar Enlace (color de acento) --}}
              <button type="submit" class="btn btn-warning text-dark">
                <i class="bi bi-send me-2"></i> Enviar Enlace
              </button>
            </div>
          </form>
        </div> {{-- Fin del card-body --}}
      </div> {{-- Fin del card --}}
    </div> {{-- Fin del col --}}
  </div> {{-- Fin del row --}}
</div> {{-- Fin del container --}}
@endsection