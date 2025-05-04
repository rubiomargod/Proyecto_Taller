<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--ColorP);">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link @if(request()->routeIs('MANTENIMIENTOS')) active text-color-s @endif"
            @if(request()->routeIs('MANTENIMIENTOS')) aria-current="page" @endif
            href="{{ route('MANTENIMIENTOS') }}">
            Mantenimientos
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if(request()->routeIs('MAQUINAS')) active text-color-s @endif"
            @if(request()->routeIs('MAQUINAS')) aria-current="page" @endif
            href="{{ route('MAQUINAS') }}">
            Maquinas
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if(request()->routeIs('MECANICOS')) active text-color-s @endif"
            @if(request()->routeIs('MECANICOS')) aria-current="page" @endif
            href="{{ route('MECANICOS') }}">
            Mecanicos
          </a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAuth" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdownAuth">
            <li>
              <a class="dropdown-item" href="{{ route('profile.edit') }}">
                <i class="bi bi-person-circle me-2"></i> Perfil
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">
                  <i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión
                </button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<style>
  :root {
    --ColorP: #3F485B;
    --ColorS: #FA6C17;
    --ColorT: #879AB5;
    --TextoN: #000;
    --TextoB: white;

    .text-color-s {
      color: var(--ColorS) !important;
    }

    .text-color-b {
      color: var(--TextoB) !important;
    }
  }

  .navbar-dark .navbar-nav .nav-link.active {
    color: var(--ColorS) !important;
  }

  .dropdown-menu-dark .dropdown-item:hover {
    background-color: var(--ColorS);
    color: var(--TextoN);
  }
</style>