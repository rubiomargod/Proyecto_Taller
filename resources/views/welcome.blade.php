<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bienvenido</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
</head>

<body class="bg-light text-dark min-vh-100 d-flex flex-column">

  <!-- Header -->
  <header class="container-fluid py-3 shadow-sm bg-white">
    <div class="container d-flex justify-content-between align-items-center">
      <!-- Logo y nombre -->
      <div class="d-flex align-items-center">
        <i class="bi bi-tools fs-3 text-primary me-2"></i>
        <span class="fs-4 fw-bold">Taller</span>
      </div>

      <!-- Opciones de navegación -->
      @if (Route::has('login'))
      <nav class="d-flex gap-2">
        @auth
        <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary">
          <i class="bi bi-speedometer2 me-1"></i> Dashboard
        </a>
        @else
        <a href="{{ route('login') }}" class="btn btn-outline-secondary">
          <i class="bi bi-box-arrow-in-right me-1"></i> Log in
        </a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="btn btn-outline-success">
          <i class="bi bi-person-plus me-1"></i> Register
        </a>
        @endif
        @endauth
      </nav>
      @endif
    </div>
  </header>

  <!-- Contenido principal -->
  <main class="container text-center my-auto py-5">
    <h1>Hola</h1>
  </main>

  <!-- Bootstrap JS (opcional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>