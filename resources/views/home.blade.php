@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@section('content')
    <style>
        /* Estilos generales para el contenido */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
        }

        /* Contenedor de los botones */
        .btn-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        /* Estilos para los botones */
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #590000;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 30%;
            min-width: 180px;
            justify-content: center;
        }

        .btn i {
            margin-right: 8px;
            font-size: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn:active {
            transform: scale(1);
        }
    </style>

    <h1>Bienvenido al Sistema de Registro Académico</h1>
    <p>Has iniciado sesión exitosamente.</p>

    <div class="btn-container">
        @if (Auth::user()->rol == 'Superadmin')
            <div class="btn">
                <i class="fas fa-user-plus"></i>
                <a href="{{ route('registro.index') }}" class="btn">Registrar nuevo usuario</a>
            </div>
            <div class="btn">
                <i class="fas fa-tasks"></i>
                <a href="{{ route('superadmin.materias.index') }}" class="btn">Administrar materias</a>
            </div>
            <div class="btn">
                <i class="fas fa-chalkboard-teacher"></i>
                <a href="{{ route('superadmin.docentes') }}" class="btn">Ver docentes</a>
            </div>
        @elseif (Auth::user()->rol == 'Docente')
            <div class="btn">
                <i class="fas fa-book"></i>
                <a href="{{ route('docente.materias') }}" class="btn">Ver mis materias</a>
            </div>
        @elseif (Auth::user()->rol == 'Alumno')
            <div class="btn">
                <i class="fas fa-book-open"></i>
                <a href="{{ route('alumno.materias') }}" class="btn">Ver mis materias</a>
            </div>
        @endif
    </div>
@endsection
