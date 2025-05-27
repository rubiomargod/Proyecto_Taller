<script>
  document.addEventListener('DOMContentLoaded', function() {
    Livewire.on('AbrirBorrarMantenimiento', () => {
      let modal = new bootstrap.Modal(document.getElementById('ModalBorrarMantenimiento'));
      modal.show();
    });

    Livewire.on('CerrarBorrarMantenimiento', () => {
      let modal = bootstrap.Modal.getInstance(document.getElementById('ModalBorrarMantenimiento'));
      modal.hide();
    });
  });
</script>
<!-- Modal Confirmar Eliminación de Máquina -->
<div class="modal fade" id="ModalBorrarMantenimiento" tabindex="-1" aria-labelledby="labelBorrarMantenimiento" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow rounded-3 border border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="labelEliminarMaquina">
          <i class="bi bi-trash3-fill me-2"></i> Confirmar Eliminación
        </h5>
        <button type="button" class="btn-close" wire:click="CerrarBorrarMantenimiento"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro que deseas eliminar el Mantenimiento de la máquina:
        <strong>{{ $Mantenimiento->maquina->marca ?? 'N/A' }} {{ $Mantenimiento->maquina->modelo ?? '' }}</strong>
        realizado por el mecánico:
        <strong>{{ $Mantenimiento->mecanico->nombres ?? 'N/A' }} {{ $Mantenimiento->mecanico->apellidos ?? 'N/A' }}</strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="CerrarBorrarMantenimiento">
          Cancelar
        </button>
        <button type="button" class="btn btn-danger" wire:click="Eliminar">
          <i class="bi bi-trash3-fill me-1"></i> Eliminar
        </button>
      </div>
    </div>
  </div>
</div>