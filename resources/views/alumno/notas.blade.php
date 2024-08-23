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
                @if ($periodo1)
                    <h2 class="text-center">Notas del Periodo 1</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Evaluación 1 <br>{{ $periodo1->P1 }}(%)</th>
                                <th>Evaluación 2 <br>{{ $periodo1->P2 }}(%)</th>
                                <th>Evaluación 3 <br>{{ $periodo1->P3 }}(%)</th>
                                <th>Evaluación 4 <br>{{ $periodo1->P4 }}(%)</th>
                                <th>Evaluación 5 <br>{{ $periodo1->P5 }}(%)</th>
                                <th>Nota Final <br>100(%)</th>
                                <th>Asistencia (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $periodo1->{'Evaluación 1'} }}</td>
                                <td>{{ $periodo1->{'Evaluación 2'} }}</td>
                                <td>{{ $periodo1->{'Evaluación 3'} }}</td>
                                <td>{{ $periodo1->{'Evaluación 4'} }}</td>
                                <td>{{ $periodo1->{'Evaluación 5'} }}</td>
                                <td>{{ $periodo1->{'Nota Final'} }}</td>
                                <td>{{ $periodo1->{'Asistencia (%)'} }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: right;">
                        <button class="imprimir-btn" onclick="imprimirPeriodo(1, {{ $periodo1->materia_id }})">Imprimir
                            Periodo 1</button>
                        <button class="imprimir-btn"
                            onclick="window.location.href='{{ route('alumno.historial', ['id' => $nota->materia_id]) }}'">Ver
                            Historial de Notas</button>
                    </div>
                @endif

                @if ($periodo2)
                    <h2 class="text-center">Notas del Periodo 2</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Evaluación 1 <br>{{ $periodo2->P1 }}(%)</th>
                                <th>Evaluación 2 <br>{{ $periodo2->P2 }}(%)</th>
                                <th>Evaluación 3 <br>{{ $periodo2->P3 }}(%)</th>
                                <th>Evaluación 4 <br>{{ $periodo2->P4 }}(%)</th>
                                <th>Evaluación 5 <br>{{ $periodo2->P5 }}(%)</th>
                                <th>Nota Final <br>100(%)</th>
                                <th>Asistencia (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $periodo2->{'Evaluación 1'} }}</td>
                                <td>{{ $periodo2->{'Evaluación 2'} }}</td>
                                <td>{{ $periodo2->{'Evaluación 3'} }}</td>
                                <td>{{ $periodo2->{'Evaluación 4'} }}</td>
                                <td>{{ $periodo2->{'Evaluación 5'} }}</td>
                                <td>{{ $periodo2->{'Nota Final'} }}</td>
                                <td>{{ $periodo2->{'Asistencia (%)'} }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: right;">
                        <button class="imprimir-btn" onclick="imprimirPeriodo(2, {{ $periodo2->materia_id }})">Imprimir
                            Periodo 2</button>
                        <button class="imprimir-btn"
                            onclick="window.location.href='{{ route('alumno.historial', ['id' => $nota->materia_id]) }}'">Ver
                            Historial de Notas</button>
                    </div>
                @endif

                @if ($periodo3)
                    <h2 class="text-center">Notas del Periodo 3</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Evaluación 1 <br>{{ $periodo3->P1 }}(%)</th>
                                <th>Evaluación 2 <br>{{ $periodo3->P2 }}(%)</th>
                                <th>Evaluación 3 <br>{{ $periodo3->P3 }}(%)</th>
                                <th>Evaluación 4 <br>{{ $periodo3->P4 }}(%)</th>
                                <th>Evaluación 5 <br>{{ $periodo3->P5 }}(%)</th>
                                <th>Nota Final <br>100(%)</th>
                                <th>Asistencia (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $periodo3->{'Evaluación 1'} }}</td>
                                <td>{{ $periodo3->{'Evaluación 2'} }}</td>
                                <td>{{ $periodo3->{'Evaluación 3'} }}</td>
                                <td>{{ $periodo3->{'Evaluación 4'} }}</td>
                                <td>{{ $periodo3->{'Evaluación 5'} }}</td>
                                <td>{{ $periodo3->{'Nota Final'} }}</td>
                                <td>{{ $periodo3->{'Asistencia (%)'} }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: right;">
                        <button class="imprimir-btn" onclick="imprimirPeriodo(3, {{ $periodo3->materia_id }})">Imprimir
                            Periodo 3</button>
                        <button class="imprimir-btn"
                            onclick="window.location.href='{{ route('alumno.historial', ['id' => $nota->materia_id]) }}'">Ver
                            Historial de Notas</button>
                    </div>
                @endif
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
