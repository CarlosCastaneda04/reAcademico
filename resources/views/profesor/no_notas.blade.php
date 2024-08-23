@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2>No se encontraron notas para esta materia.</h2>
        <a href="{{ route('docente.alumnos', ['id' => $id]) }}" class="volver-btn btn btn-primary">Volver</a>

    </div>
@endsection
