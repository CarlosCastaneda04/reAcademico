@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Alumnos de la Materia</h1>

        <!-- Gráfico de Pie para el Estado de los Alumnos -->
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center">Estado de los Alumnos</h3>
                <canvas id="estadoAlumnosChart"></canvas>
            </div>

            <!-- Gráfico de Barras para los Alumnos Activos -->
            <div class="col-md-6">
                <h3 class="text-center">Alumnos Activos</h3>
                <canvas id="alumnosActivosChart"></canvas>
            </div>
        </div>

        <!-- Buscador de Alumnos -->
        <div class="my-4">
            <input type="text" id="buscarAlumno" class="form-control" placeholder="Buscar alumno por nombre...">
        </div>

        <!-- Tabla de Alumnos -->
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
                    <tr class="alumno-row" data-estado="{{ $alumno->estado }}">
                        <td>{{ $alumno->id }}</td>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->email }}</td>
                        <td>
                            {{ $alumno->estado == 'Activo' ? 'Activo' : 'Retirado' }}
                        </td>
                        <td>
                            <a href="{{ route('docente.ver.notas', ['id' => $id, 'alumno_id' => $alumno->id]) }}"
                                class="btn btn-primary">Editar</a>
                            <a href="{{ route('docente.notas.alumno', ['id' => $id, 'alumno_id' => $alumno->id]) }}"
                                class="btn btn-secondary">Ver Notas</a>
                            <a href="{{ route('docente.agregar.notas', ['id' => $id, 'alumno_id' => $alumno->id]) }}"
                                class="btn btn-success">Agregar Notas</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="volver-btn-container">
            <button class="volver-btn" onclick="window.history.back()">Volver</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alumnos = @json($alumnos);

            // Datos para el gráfico de pie
            const activos = alumnos.filter(alumno => alumno.estado === 'Activo').length;
            const inactivos = alumnos.filter(alumno => alumno.estado !== 'Activo').length;

            const ctxPie = document.getElementById('estadoAlumnosChart').getContext('2d');
            const estadoAlumnosChart = new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Activo', 'Retirado'],
                    datasets: [{
                        data: [activos, inactivos],
                        backgroundColor: ['#4CAF50', '#F44336']
                    }]
                },
                options: {
                    onClick: function(event, elements) {
                        if (elements.length > 0) {
                            const label = this.data.labels[elements[0].index];
                            filtrarPorEstado(label);
                        }
                    }
                }
            });

            // Gráfico de barras para alumnos activos
            const ctxBar = document.getElementById('alumnosActivosChart').getContext('2d');
            const alumnosActivosChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Alumnos Activos'],
                    datasets: [{
                        label: 'Cantidad',
                        data: [activos],
                        backgroundColor: ['#4CAF50']
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Filtro por estado desde el gráfico de pie
            function filtrarPorEstado(estado) {
                const filas = document.querySelectorAll('.alumno-row');
                filas.forEach(fila => {
                    if (fila.getAttribute('data-estado') === estado || estado === '') {
                        fila.style.display = '';
                    } else {
                        fila.style.display = 'none';
                    }
                });
            }

            // Buscador instantáneo de alumnos
            document.getElementById('buscarAlumno').addEventListener('input', function() {
                const filtro = this.value.toLowerCase();
                const filas = document.querySelectorAll('.alumno-row');
                filas.forEach(fila => {
                    const nombre = fila.children[1].textContent.toLowerCase();
                    if (nombre.includes(filtro)) {
                        fila.style.display = '';
                    } else {
                        fila.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
