<style>
  /* Define tus variables de color personalizadas */
  :root {
    --ColorP: #3F485B;
    /* Color Primario */
    --ColorS: #FA6C17;
    /* Color Secundario */
    --ColorT: #879AB5;
    /* Color Terciario */
    --TextoN: #000000;
    /* Texto Negro */
    --TextoB: white;
    /* Texto Blanco */
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
    /* Oscurecer el color para hover - requiere Sass o un color fijo */
    background-color: darken(var(--ColorP), 5%);
    border-color: darken(var(--ColorP), 5%);
    color: var(--TextoB);
  }

  .btn-custom-primary:focus {
    box-shadow: 0 0 0 0.25rem rgba(var(--ColorP), 0.25);
    /* Ejemplo de sombra de enfoque */
  }

  .btn-custom-primary:active {
    /* Color para estado activo */
    background-color: darken(var(--ColorP), 10%);
    border-color: darken(var(--ColorP), 10%);
  }
</style>

<section>
  <header class="mb-3"> {{-- Reemplazado espacio vertical con margen inferior --}}
    {{-- Usando clase de encabezado de Bootstrap y aplicando color personalizado --}}
    <h2 class="h5 text-color-p"> {{-- Título más pequeño, usando ColorP --}}
      {{ __('Actualizar Contraseña') }}
    </h2>

    {{-- Usando text-muted de Bootstrap para la descripción y margen --}}
    <p class="text-muted mb-3">
      {{ __('Asegúrate de que tu cuenta use una contraseña larga y aleatoria para mayor seguridad.') }}
    </p>
  </header>

  {{-- Formulario principal de actualización de contraseña --}}
  {{-- Reemplazado mt-6 space-y-6 con margen superior y margen inferior para elementos del formulario --}}
  <form method="post" action="{{ route('password.update') }}" class="mt-3">
    @csrf
    @method('put') {{-- Usamos put para actualizar la contraseña --}}

    {{-- Campo de Contraseña Actual --}}
    {{-- Usando mb-2 para espaciado compacto --}}
    <div class="mb-2">
      {{-- Usando form-label de Bootstrap --}}
      <label for="update_password_current_password" class="form-label">{{ __('Contraseña Actual') }}</label>
      {{-- Usando form-control de Bootstrap y aplicando is-invalid si hay error en el error bag 'updatePassword' --}}
      <input
        id="update_password_current_password"
        name="current_password"
        type="password"
        class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" {{-- Reemplazado mt-1 block w-full con form-control, añadido error bag --}}
        autocomplete="current-password" />
      {{-- Usando invalid-feedback de Bootstrap para mensajes de error del error bag 'updatePassword' --}}
      @error('current_password', 'updatePassword')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    {{-- Campo de Nueva Contraseña --}}
    {{-- Usando mb-2 para espaciado compacto --}}
    <div class="mb-2">
      {{-- Usando form-label de Bootstrap --}}
      <label for="update_password_password" class="form-label">{{ __('Nueva Contraseña') }}</label>
      {{-- Usando form-control de Bootstrap y aplicando is-invalid si hay error en el error bag 'updatePassword' --}}
      <input
        id="update_password_password"
        name="password"
        type="password"
        class="form-control @error('password', 'updatePassword') is-invalid @enderror" {{-- Reemplazado mt-1 block w-full con form-control, añadido error bag --}}
        autocomplete="new-password" />
      {{-- Usando invalid-feedback de Bootstrap para mensajes de error del error bag 'updatePassword' --}}
      @error('password', 'updatePassword')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    {{-- Campo de Confirmar Nueva Contraseña --}}
    {{-- Usando mb-2 para espaciado compacto --}}
    <div class="mb-2">
      {{-- Usando form-label de Bootstrap --}}
      <label for="update_password_password_confirmation" class="form-label">{{ __('Confirmar Contraseña') }}</label>
      {{-- Usando form-control de Bootstrap y aplicando is-invalid si hay error en el error bag 'updatePassword' --}}
      <input
        id="update_password_password_confirmation"
        name="password_confirmation"
        type="password"
        class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" {{-- Reemplazado mt-1 block w-full con form-control, añadido error bag --}}
        autocomplete="new-password" />
      {{-- Usando invalid-feedback de Bootstrap para mensajes de error del error bag 'updatePassword' --}}
      @error('password_confirmation', 'updatePassword')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    {{-- Botones y mensaje de estado --}}
    {{-- Usando d-flex, align-items-center y gap-2 de Bootstrap --}}
    {{-- Usando mt-3 para espaciado superior compacto --}}
    <div class="d-flex align-items-center gap-2 mt-3">
      {{-- Botón de Guardar --}}
      {{-- Usando nuestra clase personalizada btn-custom-primary y añadiendo icono --}}
      <button type="submit" class="btn btn-custom-primary">

        {{ __('Guardar') }}
      </button>

      {{-- Mensaje de estado (Guardado) --}}
      @if (session('status') === 'password-updated')
      {{-- Manteniendo lógica de Alpine.js, reemplazando clases Tailwind con Bootstrap --}}
      {{-- Usando small y text-muted, mb-0 para quitar margen inferior --}}
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