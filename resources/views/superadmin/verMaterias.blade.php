@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@section('content')
    <h2 style="margin-top: 5%" class="text-center">Materias</h2>
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($materias as $materia)
                <div class="col-md-4 d-flex justify-content-center mb-3">
                    <a href="{{ route('superadmin.materias.detalle', $materia->id) }}" class="btn btn-outline-dark w-100">
                        {{ $materia->nombre }}<br>Docente: {{ $materia->docente_nombre }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
