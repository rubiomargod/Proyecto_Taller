@extends('Guest')
@section('title','Registrar')
@section('body')
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      {{-- Tarjeta en gris oscuro, con texto claro general --}}
      <div class="card shadow-lg border-0 rounded-lg bg-secondary text-light">

        {{-- Encabezado que es un flex container para alinear elementos --}}
        <div class="card-header d-flex align-items-center bg-warning text-dark">
          {{-- Botón para Volver (enlace con estilo de botón pequeño y contorno oscuro) --}}
          {{-- Este botón de "Volver" desde el registro va a la página de login --}}
          <a href="{{ url('/') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left"></i> Volver
          </a>

          {{-- Título centrado que ocupa el espacio restante --}}
          {{-- flex-grow-1 hace que este div ocupe todo el espacio disponible --}}
          <div class="flex-grow-1 text-center">
            <h3 class="fw-bold my-0">Registro de Usuario</h3> {{-- my-0 para evitar margen superior/inferior del h3 --}}
          </div>

          {{-- Opcional: Un div vacío o un botón invisible si necesitas un balance visual perfecto a la derecha del título --}}
          {{-- <button class="btn btn-outline-dark btn-sm invisible"><i class="bi bi-arrow-left"></i> Volver</button> --}}

        </div> {{-- Fin del card-header --}}


        <div class="card-body">
          {{-- No hay mensaje de estado de sesión por defecto en el registro, pero puedes añadirlo si tu lógica lo tiene --}}
          {{--
                    @if (session('status'))
                    <div class="alert alert-success mb-3" role="alert">
                        {{ session('status') }}
        </div>
        @endif
        --}}

        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="mb-3">
            {{-- Icono de Persona --}}
            <label for="name" class="form-label"><i class="bi bi-person me-2"></i> Nombre</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            {{-- Icono de Email --}}
            <label for="email" class="form-label"><i class="bi bi-envelope me-2"></i> Correo Electrónico</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            {{-- Icono de Candado --}}
            <label for="password" class="form-label"><i class="bi bi-lock me-2"></i> Contraseña</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
            @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            {{-- Icono de Candado (confirmar) --}}
            <label for="password_confirmation" class="form-label"><i class="bi bi-lock me-2"></i> Confirmar Contraseña</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          {{-- Contenedor para el enlace de "Ya registrado" y el botón de Registro --}}
          <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            {{-- Enlace a "Ya estás registrado?", se mantiene abajo --}}
            <a class="small text-decoration-none text-light" href="{{ route('login') }}">
              ¿Ya estás registrado?
            </a>

            {{-- Botón de Registro --}}
            <button type="submit" class="btn btn-warning text-dark">
              <i class="bi bi-person-plus me-2"></i> Registrarse {{-- Icono de agregar persona --}}
            </button>
          </div>
        </form>
      </div> {{-- Fin del card-body --}}

      {{-- Opcional: Pie de tarjeta --}}
      {{-- Puedes añadir un pie si necesitas espacio adicional o enlaces --}}
      {{-- <div class="card-footer text-center py-3 bg-secondary border-top border-dark">
                     <div class="small text-light">Algún mensaje o enlace adicional aquí</div>
                 </div> --}}

    </div> {{-- Fin del card --}}
  </div> {{-- Fin del col --}}
</div> {{-- Fin del row --}}
</div> {{-- Fin del container --}}
@endsection