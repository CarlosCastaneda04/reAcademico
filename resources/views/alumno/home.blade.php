@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Universidad Patrimonial 2</h1>
    <div class="materias-container">
        @foreach($materias as $materia)
            <a href="{{ route('alumno.notas', $materia->id) }}" class="materia-btn">{{ $materia->materia }}</a>
        @endforeach
    </div>
</div>
@endsection



