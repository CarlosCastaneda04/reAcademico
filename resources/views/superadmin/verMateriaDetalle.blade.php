@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    /* Estilos personalizados */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .retirado {
        background-color: #826e9f !important;
        color: white !important;
    }

    input[type="text"],
    select,
    button {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: white;
        color: #333;
    }

    button {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #45a049;
    }
</style>

@section('content')
    <div class="container">
        <div style="margin-top: 70%"></div>
        <div class="row justify-content-center">
            <!-- Gráfico de Pie -->
            <div class="col-md-6">
                <h3 class="text-center">Estadísticas de Alumnos</h3>
                <p class="text-center">Este gráfico refleja la proporción de alumnos activos y retirados en la materia.</p>
                <canvas id="alumnosChart" width="400" height="200"></canvas>
            </div>

            <!-- Gráfico de Barras -->
            <div class="col-md-6">
                <h3 class="text-center">Total de Alumnos Activos</h3>
                <p class="text-center">Este gráfico muestra el número total de alumnos activos en la materia.</p>
                <canvas id="activosChart" width="500" height="500"></canvas>
            </div>
        </div>

        <h2 class="text-center mt-5">Detalle de Materia: {{ $materia[0]->nombre }}</h2>
        <p class="text-center">Docente: {{ $materia[0]->docente_nombre }}</p>

        <h3 class="text-center">Listado de Alumnos</h3>

        <div class="mb-3">
            <input type="text" id="buscarAlumno" placeholder="Buscar alumno por nombre...">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nombre del Alumno</th>
                    <th>Estado</th>
                    <th>Cambiar Estado</th>
                </tr>
            </thead>
            <tbody id="alumnosTable">
                @foreach ($alumnos as $alumno)
                    <tr class="alumno-row {{ $alumno->estado == 'Retirado' ? 'retirado' : '' }}"
                        data-estado="{{ $alumno->estado }}">
                        <td>{{ $alumno->alumno_nombre }}</td>
                        <td>{{ $alumno->estado }}</td>
                        <td>
                            <form
                                action="{{ route('superadmin.materias.actualizarEstado', [$materia[0]->id, $alumno->alumno_id]) }}"
                                method="POST">
                                @csrf
                                <select name="estado">
                                    <option value="Activo" {{ $alumno->estado == 'Activo' ? 'selected' : '' }}>Activo
                                    </option>
                                    <option value="Retirado" {{ $alumno->estado == 'Retirado' ? 'selected' : '' }}>Retirado
                                    </option>
                                </select>
                                <button type="submit">Actualizar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Botón para abrir el modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarAlumnosModal">
            Agregar más alumnos
        </button>
    </div>

    <!-- Modal para agregar más alumnos -->
    <div class="modal fade" id="agregarAlumnosModal" tabindex="-1" aria-labelledby="agregarAlumnosModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarAlumnosModalLabel">Agregar Alumnos a la Materia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="carrera_id_modal">Filtrar por Carrera</label>
                        <select id="carrera_id_modal" class="form-select">
                            <option value="">Seleccione una Carrera</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label>Estudiantes Disponibles</label>
                        <select multiple id="estudiantes_disponibles_modal" class="form-select" size="10">
                            @foreach ($todosLosAlumnos as $alumno)
                                @if (!in_array($alumno->id, $alumnosSeleccionados))
                                    <option value="{{ $alumno->id }}" data-carrera="{{ $alumno->carrera_id }}">
                                        {{ $alumno->nombre }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button type="button" id="agregar_alumnos_seleccionados" class="btn btn-success">Agregar
                            Seleccionados ></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Gráficos de pie y barra (igual que antes)
        const activos = {{ $activos }};
        const retirados = {{ $retirados }};

        const ctxPie = document.getElementById('alumnosChart').getContext('2d');
        const alumnosChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Activo', 'Retirado'],
                datasets: [{
                    label: 'Estado de Alumnos',
                    data: [activos, retirados],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' alumnos';
                            }
                        }
                    }
                },
                onClick: function(event, elements) {
                    if (elements.length > 0) {
                        const label = this.data.labels[elements[0].index];
                        filtrarPorEstado(label);
                    }
                }
            }
        });

        const ctxBar = document.getElementById('activosChart').getContext('2d');
        const activosChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Activos'],
                datasets: [{
                    label: 'Total de Activos',
                    data: [activos],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' alumnos';
                            }
                        }
                    }
                }
            }
        });

        // Filtrar por estado desde el gráfico de pie
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

        // Filtrar alumnos en tiempo real en la tabla de alumnos
        document.getElementById('buscarAlumno').addEventListener('input', function() {
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll('.alumno-row');
            filas.forEach(fila => {
                const nombre = fila.children[0].textContent.toLowerCase();
                if (nombre.includes(filtro)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        });

        // Cambiar el color de la fila si el alumno está retirado
        document.addEventListener('DOMContentLoaded', function() {
            const filas = document.querySelectorAll('.alumno-row');
            filas.forEach(fila => {
                if (fila.getAttribute('data-estado') === 'Retirado') {
                    fila.classList.add('retirado');
                }
            });
        });

        // Filtrar alumnos por carrera en el modal
        document.getElementById('carrera_id_modal').addEventListener('change', function() {
            const carreraId = this.value;
            const opciones = document.querySelectorAll('#estudiantes_disponibles_modal option');
            opciones.forEach(opcion => {
                if (carreraId === '' || opcion.getAttribute('data-carrera') === carreraId) {
                    opcion.style.display = 'block';
                } else {
                    opcion.style.display = 'none';
                }
            });
        });

        // Agregar alumnos seleccionados desde el modal a la lista principal
        // Agregar alumnos seleccionados desde el modal a la lista principal y en la base de datos
        document.getElementById('agregar_alumnos_seleccionados').addEventListener('click', function() {
            const seleccionados = document.getElementById('estudiantes_disponibles_modal').selectedOptions;

            Array.from(seleccionados).forEach(opcion => {
                // Enviar solicitud AJAX al servidor para agregar el alumno en la base de datos
                fetch("{{ route('superadmin.materias.agregarAlumnos', $materia[0]->id) }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            alumno_id: opcion.value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Si la inserción en la base de datos fue exitosa, agregar el alumno a la tabla
                            const fila = document.createElement('tr');
                            fila.classList.add('alumno-row');
                            fila.setAttribute('data-estado', 'Activo');

                            fila.innerHTML = `
                    <td>${opcion.textContent}</td>
                    <td>Activo</td>
                    <td>
                        <form method="POST" action="{{ route('superadmin.materias.actualizarEstado', [$materia[0]->id, 'REPLACE_WITH_ALUMNO_ID']) }}">
                            @csrf
                            <select name="estado" class="form-select">
                                <option value="Activo" selected>Activo</option>
                                <option value="Retirado">Retirado</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Actualizar</button>
                        </form>
                    </td>
                `;

                            // Reemplazar 'REPLACE_WITH_ALUMNO_ID' con el ID real del alumno seleccionado
                            fila.innerHTML = fila.innerHTML.replace('REPLACE_WITH_ALUMNO_ID', opcion
                                .value);

                            // Añadir la fila a la tabla de alumnos
                            document.getElementById('alumnosTable').appendChild(fila);

                            // Opcionalmente, eliminar la opción seleccionada del modal para que no se vuelva a agregar
                            opcion.remove();
                        } else {
                            alert('Hubo un error al agregar el alumno a la base de datos.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Hubo un error al procesar la solicitud.');
                    });
            });

            // Cerrar el modal después de agregar los alumnos
            $('#agregarAlumnosModal').modal('hide');
        });
    </script>
@endsection
