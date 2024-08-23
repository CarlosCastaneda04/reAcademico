@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Notas del Alumno</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Periodo</th>
                    <th>Evaluación 1</th>
                    <th>Evaluación 2</th>
                    <th>Evaluación 3</th>
                    <th>Evaluación 4</th>
                    <th>Evaluación 5</th>
                    <th>Nota Final</th>
                    <th>Asistencia (%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notas as $nota)
                    <tr>
                        <td>{{ $nota->periodo }}</td>
                        <td>{{ $nota->{"Evaluación 1"} }}</td>
                        <td>{{ $nota->{"Evaluación 2"} }}</td>
                        <td>{{ $nota->{"Evaluación 3"} }}</td>
                        <td>{{ $nota->{"Evaluación 4"} }}</td>
                        <td>{{ $nota->{"Evaluación 5"} }}</td>
                        <td>{{ $nota->{"Nota Final"} }}</td>
                        <td>{{ $nota->{"Asistencia (%)"} }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
