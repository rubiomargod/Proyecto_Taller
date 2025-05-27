<div class="container-fluid px-3">
  {{-- Título principal --}}
  <div class="mb-4">
    <h2 class="fw-bold text-center border-bottom pb-2" style="color: var(--ColorS);">
      Datos Generales</h2>
  </div>

  {{-- Tarjetas de resumen --}}
  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="card shadow-sm border-0 text-white" style="background-color: var(--ColorS);">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Mantenimientos este mes</h6>
            <h3 class="mb-0 fw-bold">{{ $totalEsteMes }}</h3>
          </div>
          <i class="bi bi-tools fs-2 opacity-75"></i>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0 text-white" style="background-color: var(--ColorS);">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Próximos programados</h6>
            <h3 class="mb-0 fw-bold">{{ $totalProximoMes }}</h3>
          </div>
          <i class="bi bi-calendar-check fs-2 opacity-75"></i>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0 text-white" style="background-color: var(--ColorT);">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-1">Costo total este mes</h6>
            <h3 class="mb-0 fw-bold">${{ number_format($costoEsteMes, 2) }}</h3>
          </div>
          <i class="bi bi-currency-dollar fs-2 opacity-75"></i>
        </div>
      </div>
    </div>
  </div>

  {{-- Tabla de próximos mantenimientos --}}
  <div class="card shadow-sm border-0 mb-4">
    <div class="card-header text-white fw-semibold" style="background-color: var(--ColorP);">
      Próximos mantenimientos
    </div>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead style="background-color: #f8f9fa;">
          <tr class="text-center">
            <th>Máquina</th>
            <th>Mecánico</th>
            <th>Fecha</th>
            <th>Tipo</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($proximos as $m)
          <tr class="text-center">
            <td>{{ $m->maquina->marca ?? 'Sin asignar' }}{{ $m->maquina->modelo ?? 'Sin asignar' }}</td>
            <td>{{ $m->mecanico->nombres ?? 'Sin asignar' }} {{ $m->mecanico->apellidos ?? 'Sin asignar' }}</td>
            <td>{{ \Carbon\Carbon::parse($m->fecha_mantenimiento)->format('d/m/Y') }}</td>
            <td>
              <span class="badge bg-{{ $m->tipo_mantenimiento === 'preventivo' ? 'info' : 'danger' }}">
                {{ ucfirst($m->tipo_mantenimiento) }}
              </span>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center text-muted">Sin mantenimientos programados</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Gráficas --}}
  <div class="row g-3">
    <div class="col-md-6">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-header text-white fw-semibold" style="background-color: var(--ColorP);">
          Mantenimientos realizados en el último mes
        </div>
        <div class="card-body">
          <canvas id="graficaUltimoMes" style="max-height: 250px;"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-header text-white fw-semibold" style="background-color: var(--ColorP);">
          Mantenimientos programados para el próximo mes
        </div>
        <div class="card-body">
          <canvas id="graficaProximoMes" style="max-height: 250px;"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Chart.js Script --}}
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const datosUltimoMes = @json($mantenimientosUltimoMes);
    const datosProximoMes = @json($mantenimientosProximoMes);

    const options = {
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            color: 'var(--TextoN)'
          }
        },
        x: {
          ticks: {
            color: 'var(--TextoN)'
          }
        }
      },
      plugins: {
        legend: {
          labels: {
            color: 'var(--TextoN)'
          }
        }
      }
    };

    new Chart(document.getElementById('graficaUltimoMes').getContext('2d'), {
      type: 'line',
      data: {
        labels: Object.keys(datosUltimoMes),
        datasets: [{
          label: 'Realizados',
          data: Object.values(datosUltimoMes),
          backgroundColor: 'var(--ColorS)',
          borderColor: 'var(--ColorP)',
          borderWidth: 2,
          tension: 0.3
        }]
      },
      options
    });

    new Chart(document.getElementById('graficaProximoMes').getContext('2d'), {
      type: 'line',
      data: {
        labels: Object.keys(datosProximoMes),
        datasets: [{
          label: 'Programados',
          data: Object.values(datosProximoMes),
          backgroundColor: 'var(--ColorT)',
          borderColor: 'var(--ColorP)',
          borderWidth: 2,
          tension: 0.3
        }]
      },
      options
    });
  });
</script>