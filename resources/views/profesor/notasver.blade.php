@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-5">Notas del Alumno</h1>

    @foreach ($notas as $nota)
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white text-center">
                <strong>{{ $nota->periodo }}</strong>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Evaluación</th>
                                <th>Nota</th>
                                <th>Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Evaluación 1</td><td>{{ $nota->{'Evaluación 1'} ?? '-' }}</td><td>{{ $nota->P1 ?? '-' }}%</td></tr>
                            <tr><td>Evaluación 2</td><td>{{ $nota->{'Evaluación 2'} ?? '-' }}</td><td>{{ $nota->P2 ?? '-' }}%</td></tr>
                            <tr><td>Evaluación 3</td><td>{{ $nota->{'Evaluación 3'} ?? '-' }}</td><td>{{ $nota->P3 ?? '-' }}%</td></tr>
                            <tr><td>Evaluación 4</td><td>{{ $nota->{'Evaluación 4'} ?? '-' }}</td><td>{{ $nota->P4 ?? '-' }}%</td></tr>
                            <tr><td>Evaluación 5</td><td>{{ $nota->{'Evaluación 5'} ?? '-' }}</td><td>{{ $nota->P5 ?? '-' }}%</td></tr>
                            <tr class="fw-bold bg-light">
                                <td>Nota Final</td>
                                <td colspan="2">{{ $nota->{'Nota Final'} ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Asistencia</td>
                                <td colspan="2">{{ $nota->{'Asistencia (%)'} ?? '-' }}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach

    <div class="text-center mt-4">
        <h4>Promedios Generales</h4>
        <p><strong>Nota Final Promedio:</strong> {{ $promedioNotas }} / 10</p>
        <p><strong>Asistencia Promedio:</strong> {{ $promedioAsistencias }}%</p>
        <button class="btn btn-secondary mt-3" onclick="window.history.back()">Volver</button>
    </div>
</div>
@endsection
