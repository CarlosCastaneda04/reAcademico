@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Notas del Alumno</h1>

        @php
            $periodo1 = null;
            $periodo2 = null;
            $periodo3 = null;
            foreach ($notas as $nota) {
                if ($nota->periodo == 1 && !$periodo1) {
                    $periodo1 = $nota;
                } elseif ($nota->periodo == 2 && !$periodo2) {
                    $periodo2 = $nota;
                } elseif ($nota->periodo == 3 && !$periodo3) {
                    $periodo3 = $nota;
                }
            }
        @endphp

        @if ($periodo1)
            <h3 class="text-center">Periodo 1</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Periodo</th>
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
                        <td>{{ $periodo1->periodo }}</td>
                        <td>{{ $periodo1->{"Evaluación 1"} }}</td>
                        <td>{{ $periodo1->{"Evaluación 2"} }}</td>
                        <td>{{ $periodo1->{"Evaluación 3"} }}</td>
                        <td>{{ $periodo1->{"Evaluación 4"} }}</td>
                        <td>{{ $periodo1->{"Evaluación 5"} }}</td>
                        <td>{{ $periodo1->{"Nota Final"} }}</td>
                        <td>{{ $periodo1->{"Asistencia (%)"} }}</td>
                    </tr>
                </tbody>
            </table>
        @endif

        @if ($periodo2)
            <h3 class="text-center">Periodo 2</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Periodo</th>
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
                        <td>{{ $periodo2->periodo }}</td>
                        <td>{{ $periodo2->{"Evaluación 1"} }}</td>
                        <td>{{ $periodo2->{"Evaluación 2"} }}</td>
                        <td>{{ $periodo2->{"Evaluación 3"} }}</td>
                        <td>{{ $periodo2->{"Evaluación 4"} }}</td>
                        <td>{{ $periodo2->{"Evaluación 5"} }}</td>
                        <td>{{ $periodo2->{"Nota Final"} }}</td>
                        <td>{{ $periodo2->{"Asistencia (%)"} }}</td>
                    </tr>
                </tbody>
            </table>
        @endif

        @if ($periodo3)
            <h3 class="text-center">Periodo 3</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Periodo</th>
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
                        <td>{{ $periodo3->periodo }}</td>
                        <td>{{ $periodo3->{"Evaluación 1"} }}</td>
                        <td>{{ $periodo3->{"Evaluación 2"} }}</td>
                        <td>{{ $periodo3->{"Evaluación 3"} }}</td>
                        <td>{{ $periodo3->{"Evaluación 4"} }}</td>
                        <td>{{ $periodo3->{"Evaluación 5"} }}</td>
                        <td>{{ $periodo3->{"Nota Final"} }}</td>
                        <td>{{ $periodo3->{"Asistencia (%)"} }}</td>
                    </tr>
                </tbody>
            </table>
        @endif

        <div class="volver-btn-container">
            <button class="volver-btn" onclick="window.history.back()">Volver</button>
        </div>
    </div>
@endsection
