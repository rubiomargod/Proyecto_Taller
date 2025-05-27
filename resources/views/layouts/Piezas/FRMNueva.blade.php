<script>
  document.addEventListener('DOMContentLoaded', function() {
    Livewire.on('AbrirNuevaPieza', () => {
      let modal = new bootstrap.Modal(document.getElementById('ModalNuevaPieza'));
      modal.show();
    });

    Livewire.on('CerrarNuevaPieza', () => {
      let modal = bootstrap.Modal.getInstance(document.getElementById('ModalNuevaPieza'));
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
<div class="modal fade" id="ModalNuevaPieza" tabindex="-1" aria-labelledby="ModalNuevaPiezaLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4">
      <div class="modal-header bg-light border-0">
        <h5 class="modal-title text-dark fw-bold">
          <i class="bi bi-tools me-2"></i> Registrar Nueva Pieza
        </h5>
        <button type="button" class="btn-close" wire:click="CerrarNuevaPieza"></button>
      </div>

      <form wire:submit.prevent="{{ $Accion }}">
        <div class="modal-body">
          <div class="row g-3">

            {{-- Nombre --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Nombre</label>
              <input type="text" class="form-control" wire:model.defer="nombre" placeholder="Ej. Filtro de aceite">
              @error('nombre') <small class="text-danger">El nombre es obligatorio.</small> @enderror
            </div>

            {{-- Código --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Código</label>
              <input type="text" class="form-control" wire:model.defer="codigo" placeholder="Ej. REF-00123">
              @error('codigo') <small class="text-danger">El código es obligatorio o ya existe.</small> @enderror
            </div>

            {{-- Descripción --}}
            <div class="col-12">
              <label class="form-label fw-semibold">Descripción</label>
              <textarea class="form-control" wire:model.defer="descripcion" rows="2" placeholder="Detalle o especificaciones de la Pieza..."></textarea>
              @error('descripcion') <small class="text-danger">La descripción es obligatoria.</small> @enderror
            </div>

            {{-- Cantidad --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Cantidad</label>
              <input type="number" class="form-control" wire:model.defer="cantidad" min="0" placeholder="Ej. 10">
              @error('cantidad') <small class="text-danger">La cantidad es obligatoria o inválida.</small> @enderror
            </div>

            {{-- Precio Unitario --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Precio Unitario</label>
              <input type="number" step="0.01" class="form-control" wire:model.defer="precio_unitario" placeholder="Ej. 150.00">
              @error('precio_unitario') <small class="text-danger">El precio es obligatorio o inválido.</small> @enderror
            </div>

            {{-- Marca --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Marca</label>
              <input type="text" class="form-control" wire:model.defer="marca" placeholder="Ej. Bosch">
              @error('marca') <small class="text-danger">La marca es obligatoria.</small> @enderror
            </div>

          </div>
        </div>

        <div class="modal-footer bg-light border-0">
          <button type="button" class="btn btn-secondary" wire:click="CerrarNuevaPieza">Cancelar</button>
          <button type="submit" class="btn btn-custom-primary px-4">
            <i class="bi bi-save me-1"></i> Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>