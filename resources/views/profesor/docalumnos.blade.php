@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Alumnos de la Materia</h1>
        <table class="table">
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
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->email }}</td>
                        <td>
                            {{ $alumno->estado == 'Activo' ? 'Activo' : 'Inactivo' }}
                        </td>
                        <td>
                            <a href="{{ route('docente.ver.notas', ['id' => $id, 'alumno_id' => $alumno->id]) }}"
                                class="btn btn-primary">Editar</a>

                            <!-- Cambiar la ruta a la nueva para "Ver Notas" -->
                            <a href="{{ route('docente.notas.alumno', ['id' => $id, 'alumno_id' => $alumno->id]) }}"
                                class="btn btn-secondary">Ver Notas</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="volver-btn-container">
            <button class="volver-btn" onclick="window.history.back()">Volver</button>
        </div>
    </div>
@endsection
