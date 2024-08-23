@extends('layouts.app')

@section('content')
<div class="container">
    <div class="title">
        <h1>Universidad Patrimonial 2</h1>
    </div>
    <div class="materias-grid">
        @foreach($materias as $materia)
            <a href="{{ route('docente.alumnos', $materia->id) }}" class="materia-btn">
                {{ $materia->nombre }}
            </a>
        @endforeach
    </div>
</div>
@endsection
