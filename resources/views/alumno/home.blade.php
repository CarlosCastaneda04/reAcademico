@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Universidad Patrimonial 2</h1>
    <div class="materias-container">
        @foreach($materias as $materia)
            <a href="{{ route('alumno.notas', $materia->id) }}" class="materia-btn">{{ $materia->nombre }}</a>
        @endforeach
    </div>
</div>
@endsection

@section('styles')
    <style>
        .container {
            text-align: center;
            margin-top: 50px;
        }

        .materias-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .materia-btn {
            display: inline-block;
            padding: 15px 25px;
            font-size: 18px;
            color: #333;
            background-color: #f8f8f8;
            border-radius: 15px;
            border: 2px solid #333;
            text-decoration: none;
            width: 200px;
            text-align: center;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .materia-btn:hover {
            background-color: #333;
            color: #fff;
        }
    </style>
@endsection
