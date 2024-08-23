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
                            <a href="{{ route('docente.ver.notas', ['id' => $id, 'alumno_id' => $alumno->id]) }}"
                                class="btn btn-primary">Ver Notas</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
