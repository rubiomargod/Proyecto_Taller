{{-- Estilos personalizados (coloca esto en tu layout o componente si no lo tienes aún) --}}
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

  .btn-agregar-custom {
    background-color: var(--ColorS);
    border: none;
    color: white;
  }

  .btn-agregar-custom:hover {
    background-color: #e65a05;
  }

  .btn-accion {
    margin-right: 5px;
  }

  .modal-header-custom {
    background-color: var(--ColorP);
    color: var(--TextoB);
  }

  .modal-header-custom .btn-close {
    filter: invert(1);
  }
</style>

{{-- Modal --}}
<div class="modal fade" id="ModalDetallesMantenimiento" tabindex="-1" aria-labelledby="labelDetallesMantenimiento" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content shadow-lg border-0 rounded-3">

      {{-- CABECERA --}}
      <div class="modal-header modal-header-custom">
        <h5 class="modal-title" id="labelDetallesMantenimiento">
          <i class="bi bi-tools me-2"></i> Registrar Detalles del Mantenimiento
        </h5>
        <button type="button" class="btn-close" wire:click="CerrarDetallesMantenimiento" aria-label="Close"></button>
      </div>

      {{-- INFORMACIÓN RESUMIDA EN PANEL --}}
      <div class="px-4 pt-4 pb-2">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
          <div class="col">
            <div class="border rounded p-3 bg-light h-100">
              <small class="text-muted"><i class="bi bi-gear-fill me-1"></i>Máquina</small>
              <div class="fw-semibold text-dark-custom">{{ $Mantenimiento->maquina->marca ?? 'N/A' }} {{ $Mantenimiento->maquina->modelo ?? '' }}</div>
            </div>
          </div>
          <div class="col">
            <div class="border rounded p-3 bg-light h-100">
              <small class="text-muted"><i class="bi bi-person-fill me-1"></i>Mecánico</small>
              <div class="fw-semibold text-dark-custom">{{ $Mantenimiento->mecanico->nombres ?? 'N/A' }} {{ $Mantenimiento->mecanico->apellidos ?? 'N/A' }}</div>
            </div>
          </div>
          <div class="col">
            <div class="border rounded p-3 bg-light h-100">
              <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>Fecha</small>
              <div class="fw-semibold text-dark-custom">{{ \Carbon\Carbon::parse($fecha_mantenimiento)->format('d/m/Y') }}</div>
            </div>
          </div>
          <div class="col">
            <div class="border rounded p-3 bg-light h-100">
              <small class="text-muted"><i class="bi bi-wrench me-1"></i>Tipo</small>
              <div class="fw-semibold text-capitalize text-dark-custom">{{ $tipo_mantenimiento }}</div>
            </div>
          </div>
          <div class="col">
            <div class="border rounded p-3 bg-light h-100">
              <small class="text-muted"><i class="bi bi-cash-coin me-1"></i>Costo Total</small>
              <div class="fw-bold text-success">
                {{ $costo_total }}
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- BODY --}}
      <div class="modal-body bg-light pt-3">
        <div class="card border-light-subtle shadow-sm">
          <div class="card-body p-3">

            @if (session()->has('mensaje'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
              <i class="bi bi-check-circle-fill me-2"></i> {{ session('mensaje') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Tabla de Detalles --}}
            <div class="table-responsive">
              <table class="table table-hover table-striped table-bordered text-center align-middle table-header-custom table-striped-custom table-bordered-custom">
                <thead>
                  <tr>
                    <th style="width: 30%;">Pieza</th>
                    <th style="width: 45%;">Detalle del Servicio</th>
                    <th style="width: 15%;">Costo</th>
                    <th style="width: 10%;">Acción</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($Detalles as $indice => $Detalle)
                  <tr wire:key="Detalle-{{ $indice }}">
                    <td>
                      <select class="form-select" wire:model.live="Detalles.{{ $indice }}.fk_id_pieza">
                        <option selected disabled value="">Seleccionar pieza...</option>
                        @foreach($Piezas as $pieza)
                        <option value="{{ $pieza->id }}">{{ $pieza->nombre }}</option>
                        @endforeach
                      </select>
                      @error('Detalles.'.$indice.'.fk_id_pieza') <span class="text-danger small">{{ $message }}</span> @enderror
                    </td>
                    <td>
                      <input type="text" class="form-control" placeholder="Ej: Cambio de aceite..." wire:model.live="Detalles.{{ $indice }}.detalle">
                      @error('Detalles.'.$indice.'.detalle') <span class="text-danger small">{{ $message }}</span> @enderror
                    </td>
                    <td>
                      <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" step="0.01" placeholder="0.00" wire:model.live="Detalles.{{ $indice }}.costo">
                      </div>
                      @error('Detalles.'.$indice.'.costo') <span class="text-danger small">{{ $message }}</span> @enderror
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger btn-sm" wire:click="EliminarDetalle({{ $indice }})">
                        <i class="bi bi-trash3-fill"></i>
                      </button>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4" class="text-muted text-center py-4">
                      <i class="bi bi-plus-circle-dotted fs-4"></i>
                      <p class="mt-2 mb-0">Agrega un nuevo Detalle para comenzar.</p>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
              <button type="button" class="btn btn-agregar-custom" wire:click="AgregarDetalle">
                <i class="bi bi-plus-circle me-1"></i> Agregar Detalle
              </button>
            </div>

          </div>
        </div>
      </div>

      {{-- FOOTER --}}
      <div class="modal-footer bg-light border-0 d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" wire:click="CerrarDetallesMantenimiento">
          <i class="bi bi-x-lg me-1"></i> Cerrar
        </button>
        <button type="button" class="btn btn-success" wire:click="GuardarDetalles" wire:loading.attr="disabled">
          <span wire:loading.remove wire:target="GuardarDetalles">
            <i class="bi bi-save me-1"></i> Guardar Cambios
          </span>
          <span wire:loading wire:target="GuardarDetalles">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Guardando...
          </span>
        </button>
      </div>

    </div>
  </div>
</div>
<script>
  document.addEventListener('livewire:initialized', () => {
    const modalElement = document.getElementById('ModalDetallesMantenimiento');
    const modal = new bootstrap.Modal(modalElement);

    Livewire.on('AbrirDetallesMantenimiento', () => {
      modal.show();
    });

    Livewire.on('CerrarDetallesMantenimiento', () => {
      modal.hide();
    });
  });
</script>