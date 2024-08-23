@extends('layouts.app')

@section('content')
    <h2>Lista de Docentes</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($docentes as $docente)
                <tr>
                    <td>{{ $docente->nombre }}</td>
                    <td>{{ $docente->email }}</td>
                    <td>
                        <a href="{{ route('superadmin.docentes.materias', $docente->id) }}" class="btn btn-primary">Ver
                            Materias</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
