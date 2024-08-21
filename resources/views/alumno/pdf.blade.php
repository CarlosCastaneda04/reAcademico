<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas de Periodo</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Notas de {{ $notas[0]->materia }} - Periodo {{ $notas[0]->periodo }}</h2>
    <table>
        <thead>
            <tr>
                <th>Evaluación 1</th>
                <th>Evaluación 2</th>
                <th>Evaluación 3</th>
                <th>Evaluación 4</th>
                <th>Evaluación 5</th>
                <th>Nota Final</th>
                <th>Asistencia (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notas as $nota)
            <tr>
                <td>{{ $nota->{'Evaluación 1'} }}</td>
                <td>{{ $nota->{'Evaluación 2'} }}</td>
                <td>{{ $nota->{'Evaluación 3'} }}</td>
                <td>{{ $nota->{'Evaluación 4'} }}</td>
                <td>{{ $nota->{'Evaluación 5'} }}</td>
                <td>{{ $nota->{'Nota Final'} }}</td>
                <td>{{ $nota->{'Asistencia (%)'} }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
