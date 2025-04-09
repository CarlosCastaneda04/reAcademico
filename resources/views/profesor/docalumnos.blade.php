@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Alumnos de la Materia</h1>

        <!-- Filtros agrupados -->
        <div class="mb-4 p-3 bg-light rounded border">
            <!-- Filtro por letras -->
            <label class="mb-1"><strong>Filtrar por letra:</strong></label>
            <div id="letrasFiltro" class="mb-3 d-flex flex-wrap gap-2">
                @foreach (range('A', 'Z') as $letra)
                    <button type="button"
                            class="btn btn-sm btn-outline-primary letra-btn"
                            data-letra="{{ $letra }}">
                        {{ $letra }}
                    </button>
                @endforeach
                <button id="resetFiltro" class="btn btn-sm btn-danger ms-2" type="button">🧹 Limpiar Filtro</button>
            </div>

            <!-- Filtro por estado -->
            <label for="estadoFiltro" class="mb-1"><strong>Filtrar por estado:</strong></label>
            <select id="estadoFiltro" class="form-select form-select-sm w-auto">
                <option value="">Todos</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>

        <!-- Tabla de alumnos -->
        <table class="table" id="tablaAlumnos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->id }}</td>
                        <td class="nombre">{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->email }}</td>
                        <td class="estado">{{ $alumno->estado == 'Activo' ? 'Activo' : 'Inactivo' }}</td>
                        <td>
                            <a href="{{ route('docente.ver.notas', ['id' => $id, 'alumno_id' => $alumno->id]) }}"
                               class="btn btn-primary">Editar</a>
                            <a href="{{ route('docente.notas.alumno', ['id' => $id, 'alumno_id' => $alumno->id]) }}"
                               class="btn btn-secondary">Ver Notas</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Botón volver -->
        <div class="volver-btn-container mt-3">
            <button class="volver-btn btn btn-secondary" onclick="window.history.back()">Volver</button>
        </div>
    </div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const letraBtns = document.querySelectorAll('.letra-btn');
    const resetBtn = document.getElementById('resetFiltro');
    const estadoFiltro = document.getElementById('estadoFiltro');
    const tabla = document.getElementById('tablaAlumnos').getElementsByTagName('tbody')[0];
    const letrasSeleccionadas = new Set();

    const actualizarEstilosBotones = () => {
        letraBtns.forEach(btn => {
            const letra = btn.dataset.letra;
            if (letrasSeleccionadas.has(letra)) {
                btn.classList.remove('btn-outline-primary');
                btn.classList.add('btn-dark', 'text-white', 'fw-bold');
                btn.style.transform = 'scale(1.25)';
                btn.style.transition = 'all 0.2s ease';
            } else {
                btn.classList.remove('btn-dark', 'text-white', 'fw-bold');
                btn.classList.add('btn-outline-primary');
                btn.style.transform = 'scale(1)';
            }
        });
    };

    const aplicarFiltros = () => {
        const estadoSeleccionado = estadoFiltro.value;

        Array.from(tabla.rows).forEach(row => {
            const nombre = row.querySelector('.nombre').textContent.trim().toUpperCase();
            const estado = row.querySelector('.estado').textContent.trim();
            const primeraLetra = nombre.charAt(0);

            const cumpleLetra = letrasSeleccionadas.size === 0 ||
                                Array.from(letrasSeleccionadas).some(letra => nombre.startsWith(letra));

            const cumpleEstado = estadoSeleccionado === '' || estado === estadoSeleccionado;

            row.style.display = (cumpleLetra && cumpleEstado) ? '' : 'none';
        });
    };

    letraBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const letra = btn.dataset.letra;

            if (letrasSeleccionadas.has(letra)) {
                letrasSeleccionadas.delete(letra);
            } else {
                letrasSeleccionadas.add(letra);
            }

            actualizarEstilosBotones();
            aplicarFiltros();
        });
    });

    resetBtn.addEventListener('click', () => {
        letrasSeleccionadas.clear();
        estadoFiltro.value = '';
        actualizarEstilosBotones();
        aplicarFiltros();
    });

    estadoFiltro.addEventListener('change', aplicarFiltros);
});
</script>

<style>
.letra-btn {
    min-width: 40px;
    transition: all 0.2s ease;
}
.letra-btn.active {
    box-shadow: 0 0 8px rgba(0,0,0,0.3);
}
</style>
@endsection
