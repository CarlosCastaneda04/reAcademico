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

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
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
    @foreach ($notas as $nota)
        <h2>Notas de {{ $notas[0]->materia }} - Periodo {{ $notas[0]->periodo }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Evaluación 1 <br>{{ $nota->{'P1'} }}(%)</th>
                    <th>Evaluación 2 <br>{{ $nota->{'P2'} }}(%)</th>
                    <th>Evaluación 3 <br>{{ $nota->{'P3'} }}(%)</th>
                    <th>Evaluación 4 <br>{{ $nota->{'P4'} }}(%)</th>
                    <th>Evaluación 5 <br>{{ $nota->{'P5'} }}(%)</th>
                    <th>Nota Final <br>100(%)</th>
                    <th>Asistencia (%)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $nota->{'Evaluación 1'} }}</td>
                    <td>{{ $nota->{'Evaluación 2'} }}</td>
                    <td>{{ $nota->{'Evaluación 3'} }}</td>
                    <td>{{ $nota->{'Evaluación 4'} }}</td>
                    <td>{{ $nota->{'Evaluación 5'} }}</td>
                    <td>{{ $nota->{'Nota Final'} }}</td>
                    <td>{{ $nota->{'Asistencia (%)'} }}</td>
                </tr>
            </tbody>
        </table>
    @endforeach

</body>

</html>
