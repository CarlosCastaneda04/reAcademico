@extends('layouts.app')

@section('content')
    <h1>Bienvenido al Sistema de Registro Académico</h1>
    <p>Has iniciado sesión exitosamente.</p>

    @if (Auth::user()->rol == 'Superadmin')
        <p>Eres un Superadmin. Tienes acceso a la administración del sistema.</p>
        <a href="{{ route('registro.index') }}">Registrar nuevo usuario</a>
        <a href="{{ route('superadmin.materias.index') }}">Administrar materias</a>
        <a href="{{ route('superadmin.docentes') }}">Ver docentes</a>
    @elseif (Auth::user()->rol == 'Docente')
        <p>Eres un Docente. Puedes gestionar tus materias y estudiantes.</p>
        <a href="{{ route('docente.materias') }}">Ver mis materias</a>
    @elseif (Auth::user()->rol == 'Alumno')
        <p>Eres un Alumno. Puedes ver tus materias y calificaciones.</p>
        <a href="{{ route('alumno.materias') }}">Ver mis materias</a>
    @endif
@endsection
