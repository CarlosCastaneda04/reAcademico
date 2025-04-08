@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Historial de Notas</h1>
        @if (count($historial) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Periodo</th>
                        <th>Evaluación 1</th>
                        <th>Evaluación 2</th>
                        <th>Evaluación 3</th>
                        <th>Evaluación 4</th>
                        <th>Evaluación 5</th>
                        <th>Fecha de Modificación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historial as $registro)
                        <tr>
                            <td>{{ $registro->periodo }}</td>
                            <td>{{ $registro->{"Evaluación 1"} }}</td>
                            <td>{{ $registro->{"Evaluación 2"} }}</td>
                            <td>{{ $registro->{"Evaluación 3"} }}</td>
                            <td>{{ $registro->{"Evaluación 4"} }}</td>
                            <td>{{ $registro->{"Evaluación 5"} }}</td>
                            <td>{{ $registro->{"Fecha de Modificación"} }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center">No hay historial de notas para esta materia.</p>
        @endif
    </div>
    <div class="volver-btn-container">
        <button class="volver-btn" onclick="window.history.back()">Volver</button>
    </div>
@endsection
