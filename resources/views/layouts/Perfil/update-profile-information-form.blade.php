<style>
  :root {
    --ColorP: #3F485B;
    --ColorS: #FA6C17;
    --ColorT: #879AB5;
    --TextoN: #000000;
    --TextoB: white;
  }

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
</style>
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
    {{-- Margen inferior reducido de mb-3 a mb-2 --}}
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

    {{-- Margen inferior reducido de mb-3 a mb-2 --}}
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

    {{-- Margen superior reducido de mt-4 a mt-3 y espacio reducido de gap-3 a gap-2 --}}
    <div class="d-flex align-items-center gap-2 mt-3">
      <button type="submit" class="btn btn-custom-primary">
        {{ __('Guardar') }}
      </button>

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