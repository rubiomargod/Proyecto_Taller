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

  .text-color-p {
    color: var(--ColorP);
  }

  .btn-outline-color-p {
    --bs-btn-color: var(--ColorP);
    --bs-btn-border-color: var(--ColorP);
    --bs-btn-hover-color: var(--TextoB);
    --bs-btn-hover-bg: var(--ColorP);
    --bs-btn-hover-border-color: var(--ColorP);
    --bs-btn-focus-shadow-rgb: 63, 72, 91;
    --bs-btn-active-color: var(--TextoB);
    --bs-btn-active-bg: darken(var(--ColorP), 10%);
    --bs-btn-active-border-color: darken(var(--ColorP), 10%);
    --bs-btn-disabled-color: var(--ColorP);
    --bs-btn-disabled-border-color: var(--ColorP);
  }

  .btn-outline-color-t {
    --bs-btn-color: var(--ColorT);
    --bs-btn-border-color: var(--ColorT);
    --bs-btn-hover-color: var(--TextoB);
    --bs-btn-hover-bg: var(--ColorT);
    --bs-btn-hover-border-color: var(--ColorT);
    --bs-btn-focus-shadow-rgb: 135, 154, 181;
    --bs-btn-active-color: var(--TextoB);
    --bs-btn-active-bg: darken(var(--ColorT), 10%);
    --bs-btn-active-border-color: darken(var(--ColorT), 10%);
    --bs-btn-disabled-color: var(--ColorT);
    --bs-btn-disabled-border-color: var(--ColorT);
  }
</style>

<header class="container-fluid py-3 shadow-sm bg-white">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <i class="bi bi-tools fs-3 text-color-p me-2"></i>
      <span class="fs-4 fw-bold text-color-p">Taller</span>
    </div>

    @if (Route::has('login'))
    <nav class="d-flex gap-2">
      @auth
      <a href="{{ route('INICIO') }}" class="btn btn-outline-color-p">
        <i class="bi bi-speedometer2 me-1"></i> Inicio
      </a>
      @else
      <a href="{{ route('login') }}" class="btn btn-outline-color-t">
        <i class="bi bi-box-arrow-in-right me-1"></i> {{ __('Iniciar Sesión') }}
      </a>

      @if (Route::has('register'))
      <a href="{{ route('register') }}" class="btn btn-outline-color-p">
        <i class="bi bi-person-plus me-1"></i> {{ __('Registrarse') }}
      </a>
      @endif
      @endauth
    </nav>
    @endif
  </div>
</header>