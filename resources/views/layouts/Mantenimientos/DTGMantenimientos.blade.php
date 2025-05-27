<style>
  :root {
    --ColorP: #3F485B;
    --ColorS: #FA6C17;
    --ColorT: #879AB5;
    --TextoN: #000000;
    --TextoB: white;
  }

  .table-header-custom {
    background-color: var(--ColorP);
    color: var(--TextoB);
    border-color: var(--ColorP);
  }

  .table-header-custom th {
    color: var(--TextoB);
    border-color: var(--ColorP);
  }

  .table-striped-custom tbody tr:nth-of-type(odd) {
    background-color: rgba(135, 154, 181, 0.1);
  }

  .table-bordered-custom {
    border-color: var(--ColorT);
  }

  .table-bordered-custom th,
  .table-bordered-custom td {
    border-color: var(--ColorT);
  }

  .text-dark-custom {
    color: var(--TextoN) !important;
  }

  .btn-accion {
    margin-right: 5px;
  }
</style>

<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-11">
      <div class="card">
        <h1 class="card-header bg-light text-center text-dark-custom">
          Mantenimientos
        </h1>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped-custom table-bordered-custom align-middle">
              <thead class="table-header-custom">
                <tr>
                  <th>Mecánico</th>
                  <th>Máquina</th>
                  <th>Fecha</th>
                  <th>Tipo</th>
                  <th>Costo Total</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($Mantenimientos as $mantenimiento)
                <tr>
                  <td>{{ $mantenimiento->mecanico->nombres ?? 'N/A' }} {{ $mantenimiento->mecanico->apellidos ?? 'N/A' }}</td>
                  <td>{{ $mantenimiento->maquina->marca ?? 'N/A' }} {{ $mantenimiento->maquina->modelo ?? 'N/A' }}</td>
                  <td>{{ \Carbon\Carbon::parse($mantenimiento->fecha_mantenimiento)->format('d/m/Y') }}</td>
                  <td>{{ ucfirst($mantenimiento->tipo_mantenimiento) }}</td>
                  <td>${{ number_format($mantenimiento->costo_total, 2) }}</td>
                  <td>
                    <div class="d-flex justify-content-center gap-1">
                      <button class="btn btn-warning btn-sm" wire:click="AbrirDetallesMantenimiento({{$mantenimiento->id}})">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-primary btn-sm" wire:click="AbrirEditarMantenimiento({{$mantenimiento->id}})">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <button class="btn btn-danger btn-sm" wire:click="AbrirBorrarMantenimiento({{$mantenimiento->id}})">
                        <i class="bi bi-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>