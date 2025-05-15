<style>
  :root {
    --ColorP: #3F485B;
    /* Color Primario (Gris Oscuro Azulado) */
    --ColorS: #FA6C17;
    /* Color Secundario (Naranja) */
    --ColorT: #879AB5;
    /* Color Terciario (Gris Azulado Claro) */
    --TextoN: #000000;
    /* Texto Negro (aseguramos que sea negro completo) */
    --TextoB: white;
    /* Texto Blanco */
  }

  /* Clases personalizadas para aplicar los colores */
  .btn-buscar-custom {
    background-color: var(--ColorT);
    /* Color inicial: Terciario */
    color: var(--TextoB);
    border-color: var(--ColorS);
    /* Color inicial: Terciario */
    transition: background-color 0.3s ease, border-color 0.3s ease;
    /* Añadir transición suave */
  }

  .btn-buscar-custom:hover {
    background-color: var(--ColorS);
    /* Hover: Naranja */
    border-color: var(--ColorS);
    /* Hover: Naranja */
  }

  .btn-agregar-custom {
    background-color: var(--ColorT);
    /* Color inicial: Terciario */
    color: var(--TextoB);
    border-color: var(--ColorS);
    /* Color inicial: Terciario */
    transition: background-color 0.3s ease, border-color 0.3s ease;
    /* Añadir transición suave */
  }

  .btn-agregar-custom:hover {
    background-color: var(--ColorS);
    /* Hover: Naranja */
    border-color: var(--ColorS);
    /* Hover: Naranja */
  }

  .form-control-custom {
    border-color: var(--ColorT);
    /* Borde del input con Color Terciario */
    color: var(--TextoN);
    /* Color del texto del input */
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    /* Añadir transición suave */
  }

  .form-control-custom:focus {
    border-color: var(--ColorS);
    /* Borde naranja al enfocar */
    box-shadow: 0 0 0 0.25rem rgba(250, 108, 23, 0.25);
    /* Sombra naranja al enfocar */
  }

  /* Estilo para el color del texto dentro del input */
  .form-control-custom::placeholder {
    color: var(--ColorP);
    /* Color del placeholder con Color Primario */
    opacity: 1;
    /* Asegurar que el color del placeholder no tenga transparencia por defecto */
  }
</style>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="input-group mb-3">
        <input type="text" class="form-control form-control-custom" placeholder="Buscar..." aria-label="Buscar" wire:model.live="Search">
        <button class="btn btn-buscar-custom" type="button" id="button-search" wire:click="Buscar">
          Buscar
        </button>
        <button class="btn btn-agregar-custom" type="button" id="button-add-new" wire:click="AbrirNueva">
          Agregar Nuevo
        </button>
      </div>
    </div>
  </div>
</div>