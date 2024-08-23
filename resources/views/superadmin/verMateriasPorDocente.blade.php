@extends('layouts.app')

@section('content')
    <h2>Materias impartidas por {{ $docente[0]->nombre }}</h2>

    @if (count($materias) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre de la Materia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materias as $materia)
                    <tr>
                        <td>{{ $materia->nombre }}</td>
                        <td>
                            <a href="{{ route('superadmin.materias.detalle', $materia->id) }}" class="btn btn-primary">Ver
                                Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Este docente no imparte ninguna materia.</p>
    @endif
@endsection
