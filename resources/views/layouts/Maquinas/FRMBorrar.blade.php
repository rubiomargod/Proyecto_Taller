<script>
  document.addEventListener('DOMContentLoaded', function() {
    Livewire.on('AbrirBorrarMaquina', () => {
      let modal = new bootstrap.Modal(document.getElementById('ModalBorrarMaquina'));
      modal.show();
    });

    Livewire.on('CerrarBorrarMaquina', () => {
      let modal = bootstrap.Modal.getInstance(document.getElementById('ModalBorrarMaquina'));
      modal.hide();
    });
  });
</script>
<!-- Modal Confirmar Eliminación de Máquina -->
<div class="modal fade" id="ModalBorrarMaquina" tabindex="-1" aria-labelledby="labelEliminarMaquina" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow rounded-3 border border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="labelEliminarMaquina">
          <i class="bi bi-trash3-fill me-2"></i> Confirmar Eliminación
        </h5>
        <button type="button" class="btn-close" wire:click="CerrarBorrarMaquina"></button>
      </div>
      <div class="modal-body">
        <p class="text-dark mb-0">
          ¿Estás seguro que deseas eliminar la máquina <strong>{{ $marca }} {{ $modelo }}</strong> con número de serie <strong>{{ $numero_serie }}</strong>?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="CerrarBorrarMaquina">
          Cancelar
        </button>
        <button type="button" class="btn btn-danger" wire:click="EliminarMaquina({{ $maquina_id }})">
          <i class="bi bi-trash3-fill me-1"></i> Eliminar
        </button>
      </div>
    </div>
  </div>
</div>