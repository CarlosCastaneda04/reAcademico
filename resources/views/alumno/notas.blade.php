@extends('layouts.app')

@section('content')
    <div class="container">
        @if (count($notas) > 0)
            <h1 class="text-center">Notas de {{ $notas[0]->materia }}</h1>

            @php
                $periodo1 = null;
                $periodo2 = null;
                $periodo3 = null;
                foreach ($notas as $nota) {
                    if ($nota->periodo == 1) {
                        $periodo1 = $nota;
                    } elseif ($nota->periodo == 2) {
                        $periodo2 = $nota;
                    } elseif ($nota->periodo == 3) {
                        $periodo3 = $nota;
                    }
                }
            @endphp

            <div class="periodo-container">
                @foreach ($notas as $nota)
                    <h2 class="text-center">Notas {{ $nota->periodo }} periodo</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Evaluación 1 <br>{{ $nota->{'P1'} }}(%)</th>
                                <th>Evaluación 2 <br>{{ $nota->{'P2'} }}(%)</th>
                                <th>Evaluación 3 <br>{{ $nota->{'P3'} }}(%)</th>
                                <th>Evaluación 4 <br>{{ $nota->{'P4'} }}(%)</th>
                                <th>Evaluación 5 <br>{{ $nota->{'P5'} }}(%)</th>
                                <th>Nota Final <br>100(%)</th>
                                <th>Asistencia (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $nota->{'Evaluación 1'} }}</td>
                                <td>{{ $nota->{'Evaluación 2'} }}</td>
                                <td>{{ $nota->{'Evaluación 3'} }}</td>
                                <td>{{ $nota->{'Evaluación 4'} }}</td>
                                <td>{{ $nota->{'Evaluación 5'} }}</td>
                                <td>{{ $nota->{'Nota Final'} }}</td>
                                <td>{{ $nota->{'Asistencia (%)'} }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: right;">
                        <button class="imprimir-btn"
                            onclick="imprimirPeriodo({{ $nota->periodo }}, {{ $nota->materia_id }})">Imprimir
                            {{ $nota->periodo }} periodo</button>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center">No se encontraron notas para esta materia.</p>
        @endif
        <div class="volver-btn-container">
            <button class="volver-btn" onclick="window.history.back()">Volver</button>
        </div>
    </div>

    <script>
        function imprimirPeriodo(periodo, materiaId) {
            const url = `/alumno/imprimir/${materiaId}/${periodo}`;
            window.location.href = url;
        }
    </script>
@endsection
