@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/docnotas.css') }}">

<div class="container">
    <h1>Notas de Juan Jose Perez Pereira</h1>
    <div class="period-container">
        <h2>Notas primer periodo</h2>
        <button class="edit-button">EDITAR</button>
    </div>
    <table class="grades-table">
        <thead>
            <tr>
                <th>Eva.1</th>
                <th>Eva.2</th>
                <th>Eva.3</th>
                <th>Eva.4</th>
                <th>Eva.5</th>
                <th>Parcial</th>
                <th>Nota final</th>
                <th>Asistencia</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>9</td>
                <td>9</td>
                <td></td>
                <td></td>
                <td></td>
                <td>9</td>
                <td>9</td>
                <td>90%</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
