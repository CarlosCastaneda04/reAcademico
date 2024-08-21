@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Notas de {{ $notas[0]->materia_nombre }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Periodo</th>
                <th>Nota 1</th>
                <th>Nota 2</th>
                <th>Nota 3</th>
                <th>Nota 4</th>
                <th>Nota 5</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notas as $nota)
            <tr>
                <td>{{ $nota->periodo }}</td>
                <td>{{ $nota->nota1 }}</td>
                <td>{{ $nota->nota2 }}</td>
                <td>{{ $nota->nota3 }}</td>
                <td>{{ $nota->nota4 }}</td>
                <td>{{ $nota->nota5 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('styles')
    <style>
        .container {
            margin-top: 50px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }
    </style>
@endsection

