@extends('layouts.app')

@section('content')
    <h2>Dar de Baja a un Alumno</h2>
    <form action="{{ route('superadmin.alumnos.baja.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="materia_id">Materia</label>
            <select name="materia_id" id="materia_id" class="form-control" required>
                @foreach($materias as $materia)
                    <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="alumno_id">Alumno</label>
            <select name="alumno_id" id="alumno_id" class="form-control" required>
                @foreach($materias as $materia)
                    @foreach($materia->matriculas as $matricula)
                        <option value="{{ $matricula->alumno->id }}">{{ $matricula->alumno->nombre }}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="Activo">Activo</option>
                <option value="Retirado">Retirado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Estado</button>
    </form>
@endsection
