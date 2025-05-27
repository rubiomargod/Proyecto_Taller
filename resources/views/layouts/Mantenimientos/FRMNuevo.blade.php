<script>
  document.addEventListener('DOMContentLoaded', function() {
    Livewire.on('AbrirNuevoMantenimiento', () => {
      let modal = new bootstrap.Modal(document.getElementById('ModalNuevoMantenimiento'));
      modal.show();
    });

    Livewire.on('CerrarNuevoMantenimiento', () => {
      let modal = bootstrap.Modal.getInstance(document.getElementById('ModalNuevoMantenimiento'));
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
<div class="modal fade" id="ModalNuevoMantenimiento" tabindex="-1" aria-labelledby="ModalNuevoMantenimientoLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4">
      <div class="modal-header bg-light border-0">
        <h5 class="modal-title text-dark fw-bold">
          <i class="bi bi-wrench-adjustable-circle me-2"></i> Registrar Mantenimiento
        </h5>
        <button type="button" class="btn-close" wire:click="CerrarNuevoMantenimiento"></button>
      </div>
      <form wire:submit.prevent="{{ $Accion }}">
        <div class="modal-body">
          <div class="row g-3">
            {{-- Mecánico --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Mecánico</label>
              <select class="form-select" wire:model.defer="fk_id_mecanico">
                <option value="{{$fk_id_mecanico}}">Seleccione un mecánico</option>
                @foreach($Mecanicos as $mecanico)
                <option value="{{ $mecanico->id }}">{{ $mecanico->nombres }} {{ $mecanico->apellidos }}</option>
                @endforeach
              </select>
              @error('fk_id_mecanico') <small class="text-danger">Campo obligatorio.</small> @enderror
            </div>
            {{-- Máquina --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Máquina</label>
              <select class="form-select" wire:model.defer="fk_id_maquina">
                <option value="{{$fk_id_maquina}}">Seleccione una máquina</option>
                @foreach($Maquinas as $maquina)
                <option value="{{ $maquina->id }}">{{ $maquina->marca }} {{ $maquina->modelo }}</option>
                @endforeach
              </select>
              @error('fk_id_maquina') <small class="text-danger">Campo obligatorio.</small> @enderror
            </div>
            {{-- Fecha --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Fecha de Mantenimiento</label>
              <input type="date" class="form-control" wire:model.defer="fecha_mantenimiento">
              @error('fecha_mantenimiento') <small class="text-danger">Campo obligatorio.</small> @enderror
            </div>
            {{-- Tipo --}}
            <div class="col-md-6">
              <label class="form-label fw-semibold">Tipo de Mantenimiento</label>
              <select class="form-select" wire:model.defer="tipo_mantenimiento">
                <option value="">-- Seleccionar tipo --</option>
                <option value="preventivo">Preventivo</option>
                <option value="correctivo">Correctivo</option>
                <option value="predictivo">Predictivo</option>
              </select>
              @error('tipo_mantenimiento') <small class="text-danger">Campo obligatorio.</small> @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light border-0">
          <button type="button" class="btn btn-secondary" wire:click="CerrarNuevoMantenimiento">Cancelar</button>
          <button type="submit" class="btn btn-custom-primary px-4">
            <i class="bi bi-save me-1"></i> Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>