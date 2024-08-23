@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@section('content')
    <div class="container">
        <h2>Crear Nueva Materia</h2>
        <form action="{{ route('superadmin.materias.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="nombre">Nombre de la Materia</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="docente_id">Docente</label>
                <select name="docente_id" id="docente_id" class="form-select" required>
                    @foreach ($docentes as $docente)
                        <option value="{{ $docente->id }}">{{ $docente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="carrera_id">Carrera</label>
                <select name="carrera_id" id="carrera_id" class="form-select" required>
                    <option value="">Seleccione una Carrera</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <label>Estudiantes Disponibles</label>
                    <select multiple id="estudiantes_disponibles" class="form-select" size="10">
                        @foreach ($alumnos as $alumno)
                            <option value="{{ $alumno->id }}" data-carrera="{{ $alumno->carrera_id }}">
                                {{ $alumno->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-center justify-content-center">
                    <div>
                        <button type="button" id="agregar" class="btn btn-success mb-2">Agregar ></button>
                        <button type="button" id="remover" class="btn btn-danger">
                            < Remover</button>
                    </div>
                </div>

                <div class="col-md-5">
                    <label>Estudiantes Seleccionados</label>
                    <select multiple name="alumnos[]" id="estudiantes_seleccionados" class="form-select" size="10">
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3 w-100">Crear Materia</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Filtrar alumnos según la carrera seleccionada
            $('#carrera_id').change(function() {
                var carreraId = $(this).val();
                $('#estudiantes_disponibles option').each(function() {
                    if ($(this).data('carrera') == carreraId || carreraId == '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                $('#estudiantes_disponibles').val(''); // Deseleccionar todos los alumnos disponibles
            });

            // Agregar alumnos seleccionados a la lista de seleccionados
            $('#agregar').click(function() {
                $('#estudiantes_disponibles option:selected').each(function() {
                    $(this).remove().appendTo('#estudiantes_seleccionados');
                });
            });

            // Remover alumnos seleccionados de la lista de seleccionados
            $('#remover').click(function() {
                $('#estudiantes_seleccionados option:selected').each(function() {
                    $(this).remove().appendTo('#estudiantes_disponibles');
                });
            });
        });
    </script>
@endsection
