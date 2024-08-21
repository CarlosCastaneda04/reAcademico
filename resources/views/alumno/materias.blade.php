@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/materias.css') }}" rel="stylesheet"> <!-- Asegúrate de cargar materias.css -->
@endsection

@section('content')
<div class="container">
    <h1>Universidad Patrimonial 2</h1>
    <div class="materias">
        @foreach ($materias as $materia)
            <a href="{{ route('alumno.notas', ['id' => $materia->id]) }}" class="materia-button">{{ $materia->nombre }}</a>
        @endforeach
    </div>
</div>
@endsection

