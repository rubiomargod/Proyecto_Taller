@extends('App')

@section('title', 'Perfil')

@section('body')
<style>
  /* Define tus variables de color personalizadas */
  :root {
    --ColorP: #3F485B;
    /* Color Primario (Header Background, Botón Principal) */
    --ColorS: #FA6C17;
    /* Color Secundario (Card Header Background para Info/Password, Botón Eliminar opcional) */
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

  /* Clase personalizada para el botón principal usando ColorP */
  .btn-custom-primary {
    background-color: var(--ColorP);
    border-color: var(--ColorP);
    color: var(--TextoB);
  }

  .btn-custom-primary:hover {
    background-color: darken(var(--ColorP), 5%);
    /* Requiere Sass o un color fijo */
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
</style>

{{-- Encabezado de la página --}}
{{-- Encabezado de la página - Centrado --}}
{{-- Añadida la clase text-center para centrar el contenido --}}
<div class="bg-color-p text-light py-4 text-center">
  <div class="container">
    {{-- El h1 ahora se centrará dentro del contenedor --}}
    <h1 class="h4 my-0">{{ __('Perfil') }}</h1>
  </div>
</div>

{{-- Contenedor principal para las tarjetas --}}
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">

      {{-- Tarjeta: Actualizar Información de Perfil --}}
      <div class="card mb-4 shadow-lg border-0 rounded-lg bg-color-t text-light">
        {{-- Encabezado de la tarjeta --}}
        <div class="card-header d-flex align-items-center bg-color-s text-color-n">
          {{-- Icono --}}
          <i class="bi bi-person-circle h5 me-2 my-0"></i>
          {{-- Título --}}
          <h5 class="fw-bold my-0 flex-grow-1 text-center">{{ __('Información del Perfil') }}</h5>
        </div>
        <div class="card-body">
          {{-- Contenido del formulario de actualización de perfil --}}
          <section>
            <header class="mb-3">
              <h2 class="h5 text-color-p">
                {{ __('Información del Perfil') }}
              </h2>
              <p class="text-muted mb-3">
                {{ __("Actualiza la información de perfil de tu cuenta y dirección de correo electrónico.") }}
              </p>
            </header>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
              @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="mt-3">
              @csrf
              @method('patch')

              {{-- Campo de Nombre --}}
              <div class="mb-2">
                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                <input
                  id="name"
                  name="name"
                  type="text"
                  class="form-control @error('name') is-invalid @enderror"
                  value="{{ old('name', $user->name) }}"
                  required
                  autofocus
                  autocomplete="name" />
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              {{-- Campo de Email --}}
              <div class="mb-2">
                <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                <input
                  id="email"
                  name="email"
                  type="email"
                  class="form-control @error('email') is-invalid @enderror"
                  value="{{ old('email', $user->email) }}"
                  required
                  autocomplete="username" />
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror

                {{-- Bloque de verificación de correo electrónico --}}
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                  <p class="small text-muted mt-2">
                    {{ __('Tu dirección de correo electrónico no está verificada.') }}
                    <button form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">
                      {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                    </button>
                  </p>
                  @if (session('status') === 'verification-link-sent')
                  <p class="mt-2 small text-success fw-medium">
                    {{ __('Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.') }}
                  </p>
                  @endif
                </div>
                @endif
              </div>

              {{-- Botones y mensaje de estado --}}
              <div class="d-flex align-items-center gap-2 mt-3">
                {{-- Botón de Guardar --}}
                <button type="submit" class="btn btn-custom-primary">
                  <i class="bi bi-check me-2"></i>
                  {{ __('Guardar') }}
                </button>
                {{-- Mensaje de estado (Guardado) --}}
                @if (session('status') === 'profile-updated')
                <p
                  x-data="{ show: true }"
                  x-show="show"
                  x-transition:enter.duration.150ms
                  x-transition:leave.duration.150ms
                  x-init="setTimeout(() => show = false, 2000)"
                  class="small text-muted mb-0">
                  {{ __('Guardado.') }}
                </p>
                @endif
              </div>
            </form>
          </section>
        </div>
      </div>

      {{-- Tarjeta: Actualizar Contraseña --}}
      <div class="card mb-4 shadow-lg border-0 rounded-lg bg-color-t text-light">
        {{-- Encabezado de la tarjeta --}}
        <div class="card-header d-flex align-items-center bg-color-s text-color-n">
          {{-- Icono --}}
          <i class="bi bi-lock h5 me-2 my-0"></i>
          {{-- Título --}}
          <h5 class="fw-bold my-0 flex-grow-1 text-center">{{ __('Actualizar Contraseña') }}</h5>
        </div>
        <div class="card-body">
          {{-- Contenido del formulario de actualización de contraseña --}}
          <section>
            <header class="mb-3">
              <h2 class="h5 text-color-p">
                {{ __('Actualizar Contraseña') }}
              </h2>
              <p class="text-muted mb-3">
                {{ __('Asegúrate de que tu cuenta use una contraseña larga y aleatoria para mayor seguridad.') }}
              </p>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="mt-3">
              @csrf
              @method('put')

              {{-- Campo de Contraseña Actual --}}
              <div class="mb-2">
                <label for="update_password_current_password" class="form-label">{{ __('Contraseña Actual') }}</label>
                <input
                  id="update_password_current_password"
                  name="current_password"
                  type="password"
                  class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                  autocomplete="current-password" />
                @error('current_password', 'updatePassword')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              {{-- Campo de Nueva Contraseña --}}
              <div class="mb-2">
                <label for="update_password_password" class="form-label">{{ __('Nueva Contraseña') }}</label>
                <input
                  id="update_password_password"
                  name="password"
                  type="password"
                  class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                  autocomplete="new-password" />
                @error('password', 'updatePassword')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              {{-- Campo de Confirmar Nueva Contraseña --}}
              <div class="mb-2">
                <label for="update_password_password_confirmation" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                <input
                  id="update_password_password_confirmation"
                  name="password_confirmation"
                  type="password"
                  class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                  autocomplete="new-password" />
                @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>

              {{-- Botones y mensaje de estado --}}
              <div class="d-flex align-items-center gap-2 mt-3">
                {{-- Botón de Guardar --}}
                <button type="submit" class="btn btn-custom-primary">
                  <i class="bi bi-check me-2"></i>
                  {{ __('Guardar') }}
                </button>
                {{-- Mensaje de estado (Guardado) --}}
                @if (session('status') === 'password-updated')
                <p
                  x-data="{ show: true }"
                  x-show="show"
                  x-transition:enter.duration.150ms
                  x-transition:leave.duration.150ms
                  x-init="setTimeout(() => show = false, 2000)"
                  class="small text-muted mb-0">
                  {{ __('Guardado.') }}
                </p>
                @endif
              </div>
            </form>
          </section>
        </div>
      </div>

      {{-- Tarjeta: Eliminar Cuenta --}}
      <div class="card mb-4 shadow-lg border-0 rounded-lg bg-color-t text-light">
        {{-- Encabezado de la tarjeta --}}
        <div class="card-header d-flex align-items-center bg-danger text-white"> {{-- Usamos bg-danger estándar --}}
          {{-- Icono --}}
          <i class="bi bi-exclamation-triangle-fill h5 me-2 my-0"></i>
          {{-- Título --}}
          <h5 class="fw-bold my-0 flex-grow-1 text-center">{{ __('Eliminar Cuenta') }}</h5>
        </div>
        <div class="card-body">
          {{-- Contenido de la sección Eliminar Cuenta (incluye el modal) --}}
          <section>
            <header class="mb-3">
              <h2 class="h5 text-color-p">
                {{ __('Eliminar Cuenta') }}
              </h2>
              <p class="text-muted mb-3">
                {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán borrados permanentemente. Antes de eliminar tu cuenta, por favor descarga cualquier dato o información que desees conservar.') }}
              </p>
            </header>

            {{-- Botón de Bootstrap para disparar el modal --}}
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmar-eliminacion-cuenta">
              <i class="bi bi-trash me-2"></i>
              {{ __('Eliminar Cuenta') }}
            </button>

            {{-- Estructura del Modal de Bootstrap --}}
            <div class="modal fade" id="confirmar-eliminacion-cuenta" tabindex="-1" aria-labelledby="confirmarEliminacionCuentaLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  {{-- El formulario envuelve el cuerpo y el pie del modal --}}
                  <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                      <h5 class="modal-title text-color-p" id="confirmarEliminacionCuentaLabel">
                        {{ __('¿Estás seguro de que quieres eliminar tu cuenta?') }}
                      </h5>
                      {{-- Botón de cierre de Bootstrap --}}
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>

                    <div class="modal-body">
                      <p class="text-muted mb-3">
                        {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán borrados permanentemente. Por favor, introduce tu contraseña para confirmar que deseas eliminar tu cuenta de forma permanente.') }}
                      </p>

                      <div class="mb-3">
                        <label for="password" class="form-label visually-hidden">{{ __('Contraseña') }}</label>
                        <input
                          id="password"
                          name="password"
                          type="password"
                          class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                          placeholder="{{ __('Contraseña') }}" />
                        @error('password', 'userDeletion')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>

                    <div class="modal-footer">
                      {{-- Botón Secundario de Bootstrap para cerrar modal --}}
                      <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-2"></i>
                        {{ __('Cancelar') }}
                      </button>
                      {{-- Botón Danger de Bootstrap para enviar formulario --}}
                      <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-2"></i>
                        {{ __('Eliminar Cuenta') }}
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>

    </div> {{-- Fin col --}}
  </div> {{-- Fin row --}}
</div> {{-- Fin container --}}

@endsection