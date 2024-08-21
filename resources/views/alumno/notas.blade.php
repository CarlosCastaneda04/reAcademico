@extends('layouts.app')

@section('content')
<div class="container">
    @if(count($notas) > 0)
        <h1 class="text-center">Notas de {{ $notas[0]->materia }}</h1>

        <div class="periodo-container">
            @foreach($notas as $nota)
                <h2 class="text-center">Notas {{ $nota->periodo }} periodo</h2>
                <table class="table">
                    <thead>
                        <tr>
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
            @endforeach
        </div>
    @else
        <p class="text-center">No se encontraron notas para esta materia.</p>
    @endif
</div>
@endsection
