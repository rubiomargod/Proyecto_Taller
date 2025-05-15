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

  /* Estilo para el encabezado de la tabla (aplicado al thead) */
  .table-header-custom {
    background-color: var(--ColorP);
    /* Fondo con Color Primario */
    color: var(--TextoB);
    /* Texto con Color Blanco */
    border-color: var(--ColorP);
    /* Borde con Color Primario */
  }

  .table-header-custom th {
    color: var(--TextoB);
    /* Asegurar que el texto del th sea blanco */
    border-color: var(--ColorP);
    /* Asegurar que los bordes del th sean del color primario */
  }

  /* Estilo opcional para las filas impares o pares para mejor legibilidad */
  .table-striped-custom tbody tr:nth-of-type(odd) {
    background-color: rgba(135, 154, 181, 0.1);
    /* Un toque del Color Terciario con transparencia */
  }

  /* Estilo para los bordes de la tabla */
  .table-bordered-custom {
    border-color: var(--ColorT);
    /* Bordes con Color Terciario */
  }

  .table-bordered-custom th,
  .table-bordered-custom td {
    border-color: var(--ColorT);
    /* Bordes de celdas con Color Terciario */
  }

  /* Estilo específico para el texto oscuro/negro */
  .text-dark-custom {
    color: var(--TextoN) !important;
    /* Usamos !important para asegurar que se aplique */
  }

  /* Estilo para los botones de acción dentro de la tabla */
  .btn-accion {
    margin-right: 5px;
    /* Espacio entre botones */
  }
</style>
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <h1 class="card-header bg-light text-center text-dark-custom">
          Máquinas
        </h1>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped-custom table-bordered-custom align-middle">
              <thead class="table-header-custom">
                <tr>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>Número de Serie</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              @foreach($Maquinas as $Maquina)
              <tbody>
                <tr>
                  <td>{{ $Maquina->marca }}</td>
                  <td>{{ $Maquina->modelo }}</td>
                  <td>{{ $Maquina->numero_serie }}</td>
                  <td>{{ $Maquina->descripcion }}</td>
                  <td>
                    <div class="d-flex justify-content-center gap-1">
                      <button class="btn btn-primary btn-sm" wire:click="AbrirEditar({{ $Maquina->id }})">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-danger btn-sm" wire:click="AbrirBorrar({{ $Maquina->id }})">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>