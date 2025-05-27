<script>
  document.addEventListener('DOMContentLoaded', function() {
    Livewire.on('AbrirBorrarPieza', () => {
      let modal = new bootstrap.Modal(document.getElementById('ModalBorrarPieza'));
      modal.show();
    });

    Livewire.on('CerrarBorrarPieza', () => {
      let modal = bootstrap.Modal.getInstance(document.getElementById('ModalBorrarPieza'));
      modal.hide();
    });
  });
</script>

<!-- Modal Confirmar Eliminación de Refacción -->
<div class="modal fade" id="ModalBorrarPieza" tabindex="-1" aria-labelledby="labelEliminarPieza" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow rounded-3 border border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="labelEliminarPieza">
          <i class="bi bi-trash3-fill me-2"></i> Confirmar Eliminación
        </h5>
        <button type="button" class="btn-close" wire:click="CerrarBorrarPieza"></button>
      </div>
      <div class="modal-body">
        <p class="text-dark mb-0">
          ¿Estás seguro que deseas eliminar la refacción <strong>{{ $nombre }}</strong> con código <strong>{{ $codigo }}</strong>?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="CerrarBorrarPieza">
          Cancelar
        </button>
        <button type="button" class="btn btn-danger" wire:click="Eliminar({{ $IDPieza }})">
          <i class="bi bi-trash3-fill me-1"></i> Eliminar
        </button>
      </div>
    </div>
  </div>
</div>