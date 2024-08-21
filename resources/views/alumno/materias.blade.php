@extends('layouts.app')

@section('content')
<h1>Mis Materias</h1>
<ul>
    @foreach ($materias as $materia)
        <li><a href="{{ route('alumno.notas', $materia->id) }}">{{ $materia->nombre }}</a></li>
    @endforeach
</ul>
@endsection
