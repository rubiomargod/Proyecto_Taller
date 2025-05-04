<style>
  /* Define tus variables de color personalizadas */
  :root {
    --ColorP: #3F485B;
    /* Color Primario (Header Background, Botón Principal) */
    --ColorS: #FA6C17;
    /* Color Secundario (Card Header Background para Info/Password, Botón Eliminar opcional) */
    --ColorT: #879AB5;
    /* Color Terciario (Card Background) */
    --TextoN: #000000;
    /* Texto Negro (Color de texto para headers con --ColorS) */
    --TextoB: white;
    /* Texto Blanco (Color de texto para backgrounds oscuros) */
  }

  /* Clases personalizadas para aplicar tus colores */
  .bg-color-p {
    background-color: var(--ColorP);
    color: var(--TextoB);
  }

  .bg-color-t {
    background-color: var(--ColorT);
    color: var(--TextoB);
  }

  .bg-color-s {
    background-color: var(--ColorS);
    color: var(--TextoN);
  }

  .text-color-n {
    color: var(--TextoN);
  }

  /* Clase personalizada para el botón principal usando ColorP */
  .btn-custom-primary {
    background-color: var(--ColorP);
    border-color: var(--ColorP);
    color: var(--TextoB);
  }

  .btn-custom-primary:hover {
    background-color: darken(var(--ColorP), 5%);
    /* Requiere Sass o un color fijo */
    border-color: darken(var(--ColorP), 5%);
    color: var(--TextoB);
  }

  .btn-custom-primary:focus {
    box-shadow: 0 0 0 0.25rem rgba(var(--ColorP), 0.25);
  }

  .btn-custom-primary:active {
    background-color: darken(var(--ColorP), 10%);
    border-color: darken(var(--ColorP), 10%);
  }
</style>
<div class="card-body">
  {{-- Contenido de la sección Eliminar Cuenta (incluye el modal) --}}
  <section>
    <header class="mb-3">
      <h2 class="h5 text-color-p">
        {{ __('Eliminar Cuenta') }}
      </h2>
      <p class="text-muted mb-3">
        {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán borrados permanentemente. Antes de eliminar tu cuenta, por favor descarga cualquier dato o información que desees conservar.') }}
      </p>
    </header>

    {{-- Botón de Bootstrap para disparar el modal --}}
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmar-eliminacion-cuenta">
      <i class="bi bi-trash me-2"></i>
      {{ __('Eliminar Cuenta') }}
    </button>

    {{-- Estructura del Modal de Bootstrap --}}
    <div class="modal fade" id="confirmar-eliminacion-cuenta" tabindex="-1" aria-labelledby="confirmarEliminacionCuentaLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          {{-- El formulario envuelve el cuerpo y el pie del modal --}}
          <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div class="modal-header">
              <h5 class="modal-title text-color-p" id="confirmarEliminacionCuentaLabel">
                {{ __('¿Estás seguro de que quieres eliminar tu cuenta?') }}
              </h5>
              {{-- Botón de cierre de Bootstrap --}}
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
              <p class="text-muted mb-3">
                {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán borrados permanentemente. Por favor, introduce tu contraseña para confirmar que deseas eliminar tu cuenta de forma permanente.') }}
              </p>

              <div class="mb-3">
                <label for="password" class="form-label visually-hidden">{{ __('Contraseña') }}</label>
                <input
                  id="password"
                  name="password"
                  type="password"
                  class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                  placeholder="{{ __('Contraseña') }}" />
                @error('password', 'userDeletion')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>

            <div class="modal-footer">
              {{-- Botón Secundario de Bootstrap para cerrar modal --}}
              <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                <i class="bi bi-x-lg me-2"></i>
                {{ __('Cancelar') }}
              </button>
              {{-- Botón Danger de Bootstrap para enviar formulario --}}
              <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash me-2"></i>
                {{ __('Eliminar Cuenta') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
</div>

</div> {{-- Fin col --}}
</div> {{-- Fin row --}}
</div> {{-- Fin container --}}