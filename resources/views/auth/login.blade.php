<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        {{-- Tarjeta en gris oscuro, con texto claro general --}}
        <div class="card shadow-lg border-0 rounded-lg bg-secondary text-light">

          {{-- Encabezado que es un flex container para alinear elementos --}}
          <div class="card-header d-flex align-items-center bg-warning text-dark">
            {{-- Botón para Volver (enlace con estilo de botón pequeño y contorno oscuro) --}}
            {{-- Este botón de "Volver" desde el login podría ir a la página principal "/" --}}
            <a href="{{ url('/') }}" class="btn btn-outline-dark btn-sm">
              <i class="bi bi-arrow-left"></i> Volver
            </a>

            {{-- Título centrado que ocupa el espacio restante --}}
            {{-- flex-grow-1 hace que este div ocupe todo el espacio disponible --}}
            <div class="flex-grow-1 text-center">
              <h3 class="fw-bold my-0">Iniciar Sesión</h3> {{-- my-0 para evitar margen superior/inferior del h3 --}}
            </div>

            {{-- Opcional: Un div vacío o un botón invisible si necesitas un balance visual perfecto a la derecha del título --}}
            {{-- <button class="btn btn-outline-dark btn-sm invisible"><i class="bi bi-arrow-left"></i> Volver</button> --}}

          </div> {{-- Fin del card-header --}}


          <div class="card-body">

            {{-- El alert de éxito sigue siendo verde --}}
            @if (session('status'))
            <div class="alert alert-success mb-3" role="alert">
              {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="mb-3">
                {{-- Icono de Email --}}
                <label for="email" class="form-label"><i class="bi bi-envelope me-2"></i> Correo Electrónico</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="mb-3">
                {{-- Icono de Candado --}}
                <label for="password" class="form-label"><i class="bi bi-lock me-2"></i> Contraseña</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">Recuérdame</label>
              </div>

              {{-- Contenedor para el enlace de "Olvidaste" y el botón de Login --}}
              <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                @if (Route::has('password.request'))
                {{-- Enlace a "Olvidaste tu contraseña", se mantiene abajo --}}
                <a class="small text-decoration-none text-light" href="{{ route('password.request') }}">
                  ¿Olvidaste tu contraseña?
                </a>
                @endif

                {{-- Botón de Login --}}
                <button type="submit" class="btn btn-warning text-dark">
                  <i class="bi bi-box-arrow-in-right me-2"></i> Iniciar Sesión
                </button>
              </div>
            </form>
          </div> {{-- Fin del card-body --}}

          {{-- Opcional: Pie de tarjeta con enlace de registro --}}
          {{-- Si añades un pie, puedes poner aquí el enlace para ir al registro --}}
          {{-- <div class="card-footer text-center py-3 bg-secondary border-top border-dark">
                     <div class="small"><a href="{{ route('register') }}" class="text-light text-decoration-none">¿No tienes cuenta? Regístrate</a>
        </div>
      </div> --}}

    </div> {{-- Fin del card --}}
  </div> {{-- Fin del col --}}
  </div> {{-- Fin del row --}}
  </div> {{-- Fin del container --}}
</x-guest-layout>