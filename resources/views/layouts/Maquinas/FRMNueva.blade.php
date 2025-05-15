<script>
  document.addEventListener('DOMContentLoaded', function() {
    Livewire.on('AbrirNuevaMaquina', () => {
      let modal = new bootstrap.Modal(document.getElementById('ModalNuevaMaquina'));
      modal.show();
    });

    Livewire.on('CerrarNuevaMaquina', () => {
      let modal = bootstrap.Modal.getInstance(document.getElementById('ModalNuevaMaquina'));
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

<div class="modal fade" id="ModalNuevaMaquina" tabindex="-1" aria-labelledby="ModalNuevaMaquinaLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4">
      <div class="modal-header bg-light border-0">
        <h5 class="modal-title text-dark fw-bold">
          <i class="bi bi-cpu-fill me-2"></i> Registrar Nueva Máquina
        </h5>
        <button type="button" class="btn-close" wire:click="CerrarNueva"></button>
      </div>

      <form wire:submit.prevent="{{ $Accion }}">
        <div class="modal-body">
          <div class="row g-3">

            {{-- Marca --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Marca</label>
              <input type="text" class="form-control" wire:model.defer="marca" placeholder="Ej. Caterpillar">
              @error('marca') <small class="text-danger">La marca es obligatoria.</small> @enderror
            </div>

            {{-- Modelo --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Modelo</label>
              <input type="text" class="form-control" wire:model.defer="modelo" placeholder="Ej. D6T XL">
              @error('modelo') <small class="text-danger">El modelo es obligatorio.</small> @enderror
            </div>

            {{-- Número de Serie --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Número de Serie</label>
              <input type="text" class="form-control" wire:model.defer="numero_serie" placeholder="Ej. 123456ABC">
              @error('numero_serie') <small class="text-danger">El número de serie es obligatorio o ya existe.</small> @enderror
            </div>

            {{-- Descripción --}}
            <div class="col-12">
              <label class="form-label fw-semibold">Descripción</label>
              <textarea class="form-control" wire:model.defer="descripcion" rows="3" placeholder="Descripción general de la máquina..."></textarea>
              @error('descripcion') <small class="text-danger">La descripción es obligatoria.</small> @enderror
            </div>

          </div>
        </div>

        <div class="modal-footer bg-light border-0">
          <button type="button" class="btn btn-secondary" wire:click="CerrarNueva">Cancelar</button>
          <button type="submit" class="btn btn-custom-primary px-4">
            <i class="bi bi-save me-1"></i> Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>