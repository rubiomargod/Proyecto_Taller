<script>
  document.addEventListener('DOMContentLoaded', function() {
    Livewire.on('AbrirNuevoMecanico', () => {
      let modal = new bootstrap.Modal(document.getElementById('ModalNuevoMecanico'));
      modal.show();
    });

    Livewire.on('CerrarNuevoMecanico', () => {
      let modal = bootstrap.Modal.getInstance(document.getElementById('ModalNuevoMecanico'));
      modal.hide();
    });
  });
</script>
<style>
  :root {
    --ColorP: #3F485B;
    --ColorS: #FA6C17;
    --ColorT: #879AB5;
    --TextoN: #000000;
    --TextoB: #FFFFFF;
  }

  .btn-custom-primary {
    background-color: var(--ColorP);
    border-color: var(--ColorP);
    color: var(--TextoB);
  }

  .btn-custom-primary:hover {
    background-color: #2e3647;
    border-color: #2e3647;
    color: var(--TextoB);
  }

  .btn-custom-primary:focus {
    box-shadow: 0 0 0 0.25rem rgba(63, 72, 91, 0.4);
  }

  .btn-custom-primary:active {
    background-color: #1f252f;
    border-color: #1f252f;
  }
</style>


<div class="modal fade" id="ModalNuevoMecanico" tabindex="-1" aria-labelledby="ModalNuevoMecanicoLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4">
      <div class="modal-header bg-light border-0">
        <h5 class="modal-title text-dark fw-bold">
          <i class="bi bi-person-plus-fill me-2"></i> Registrar Nuevo Mecánico
        </h5>
        <button type="button" class="btn-close" wire:click="CerrarNuevo"></button>
      </div>

      <form wire:submit.prevent="{{$accion}}">
        <div class="modal-body">
          <div class="row g-3">
            {{-- Nombres --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Nombres</label>
              <input type="text" class="form-control" wire:model.defer="nombres" placeholder="Ej. Juan">
              @error('nombres') <small class="text-danger">El campo nombres es obligatorio.</small> @enderror
            </div>

            {{-- Apellidos --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Apellidos</label>
              <input type="text" class="form-control" wire:model.defer="apellidos" placeholder="Ej. Pérez">
              @error('apellidos') <small class="text-danger">El campo apellidos es obligatorio.</small> @enderror
            </div>

            {{-- Correo --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Correo electrónico</label>
              <input type="email" class="form-control" wire:model.defer="correo" placeholder="correo@ejemplo.com">
              @error('correo') <small class="text-danger">El correo electrónico no es válido o está vacío.</small> @enderror
            </div>

            {{-- Teléfono --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Teléfono</label>
              <input type="text" class="form-control" wire:model.defer="telefono" placeholder="10 dígitos">
              @error('telefono') <small class="text-danger">El teléfono es obligatorio o no tiene el formato correcto.</small> @enderror
            </div>

            {{-- Dirección --}}
            <div class="col-12">
              <label class="form-label fw-semibold">Dirección</label>
              <textarea class="form-control" wire:model.defer="direccion" rows="2" placeholder="Calle, número, colonia, ciudad..."></textarea>
              @error('direccion') <small class="text-danger">La dirección es obligatoria.</small> @enderror
            </div>

            {{-- INE --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">INE</label>
              <input type="text" class="form-control" wire:model="ine" placeholder="Número de INE">
              @error('ine') <small class="text-danger">El campo INE es obligatorio.</small> @enderror
            </div>

            {{-- Estatus --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Estatus</label>
              <select class="form-select" wire:model.defer="estatus">
                <option value="">Seleccionar</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
              </select>
              @error('estatus') <small class="text-danger">Selecciona un estatus válido.</small> @enderror
            </div>
          </div>
        </div>

        <div class="modal-footer bg-light border-0">
          <button type="button" class="btn btn-secondary" wire:click="CerrarNuevo">Cancelar</button>
          <button type="submit" class="btn btn-custom-primary px-4">
            <i class="bi bi-save me-1"></i> Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>