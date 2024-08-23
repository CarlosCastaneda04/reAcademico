@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alumnos de la Materia</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->id }}</td>
                    <td>{{ $alumno->nombre }}</td>
                    <td>{{ $alumno->email }}</td>
                    <td>
                        <a href="{{ route('alumno.notas', ['id' => $alumno->id]) }}" class="btn btn-primary">Ver Notas</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay alumnos registrados en esta materia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
