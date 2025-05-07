<script>
  document.addEventListener('DOMContentLoaded', function() {
    Livewire.on('AbrirBorrar', () => {
      let modal = new bootstrap.Modal(document.getElementById('ModalBorrar'));
      modal.show();
    });

    Livewire.on('CerrarBorrar', () => {
      let modal = bootstrap.Modal.getInstance(document.getElementById('ModalBorrar'));
      modal.hide();
    });
  });
</script>
<!-- Modal Confirmar Eliminación -->
<div class="modal fade" id="ModalBorrar" tabindex="-1" aria-labelledby="labelEliminarMecanico" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow rounded-3 border border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="labelEliminarMecanico">
          <i class="bi bi-trash3-fill me-2"></i> Confirmar Eliminación
        </h5>
        <button type="button" class="btn-close" wire:click="CerrarBorrar"></button>
      </div>
      <div class="modal-body">
        <p class="text-dark mb-0">
          ¿Estás seguro que deseas eliminar al mecánico <strong>{{$nombres}} {{$apellidos}}</strong>?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="CerrarBorrar">
          Cancelar
        </button>
        <button type="button" class="btn btn-danger" wire:click="Eliminar({{$idMecanicoSeleccionado}})">
          <i class="bi bi-trash3-fill me-1"></i> Eliminar
        </button>
      </div>
    </div>
  </div>
</div>