@extends('layouts.app')

@section('content')
<h1>Notas</h1>
@foreach ($notas as $nota)
    <div>
        <h2>Periodo: {{ $nota->periodo }}</h2>
        <p>Nota 1: {{ $nota->nota1 }} ({{ $nota->porcentaje_nota1 }}%)</p>
        <p>Nota 2: {{ $nota->nota2 }} ({{ $nota->porcentaje_nota2 }}%)</p>
        <p>Nota 3: {{ $nota->nota3 }} ({{ $nota->porcentaje_nota3 }}%)</p>
        <p>Nota 4: {{ $nota->nota4 }} ({{ $nota->porcentaje_nota4 }}%)</p>
        <p>Nota 5: {{ $nota->nota5 }} ({{ $nota->porcentaje_nota5 }}%)</p>
        <p><strong>Promedio: {{ ($nota->nota1 * $nota->porcentaje_nota1 + $nota->nota2 * $nota->porcentaje_nota2 + $nota->nota3 * $nota->porcentaje_nota3 + $nota->nota4 * $nota->porcentaje_nota4 + $nota->nota5 * $nota->porcentaje_nota5) / 100 }}</strong></p>
        <a href="{{ route('alumno.descargar', $nota->matricula_id) }}">Descargar</a>
    </div>
@endforeach
@endsection
