@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Notas del Alumno</h1>
        @foreach ($notas as $nota)
            <table class="table">
                <thead>
                    <tr>
                        <th>Periodo</th>
                        <th>Evaluación 1 <br>{{ $nota->{'P1'} }}(%)</th>
                        <th>Evaluación 2 <br>{{ $nota->{'P1'} }}(%)</th>
                        <th>Evaluación 3 <br>{{ $nota->{'P1'} }}(%)</th>
                        <th>Evaluación 4 <br>{{ $nota->{'P1'} }}(%)</th>
                        <th>Evaluación 5 <br>{{ $nota->{'P1'} }}(%)</th>
                        <th>Nota Final <br>100(%)</th>
                        <th>Asistencia (%)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $nota->periodo }}</td>
                        <td>{{ $nota->{"Evaluación 1"} }}</td>
                        <td>{{ $nota->{"Evaluación 2"} }}</td>
                        <td>{{ $nota->{"Evaluación 3"} }}</td>
                        <td>{{ $nota->{"Evaluación 4"} }}</td>
                        <td>{{ $nota->{"Evaluación 5"} }}</td>
                        <td>{{ $nota->{"Nota Final"} }}</td>
                        <td>{{ $nota->{"Asistencia (%)"} }}</td>
                        <td>
                            
                            <button class="btn btn-secondary">Editar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    </div>
@endsection

