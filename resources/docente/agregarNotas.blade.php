<!-- resources/views/docente/agregarNotas.blade.php -->
@extends('layouts.app')

@section('content')
    <style>
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            cursor: pointer;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>

    <div class="container">
        <h2>Agregar Notas</h2>
        <form action="{{ route('docente.guardar.notas', ['id' => $id, 'alumno_id' => $alumno_id]) }}" method="POST">
            @csrf
            <input type="hidden" name="matricula_id" value="{{ $matricula_id }}">
            @for ($periodo = 1; $periodo <= 3; $periodo++)
                <h3>Periodo {{ $periodo }}</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nota 1</th>
                                <th>Nota 2</th>
                                <th>Nota 3</th>
                                <th>Nota 4</th>
                                <th>Nota 5</th>
                                <th>Porcentaje Nota 1</th>
                                <th>Porcentaje Nota 2</th>
                                <th>Porcentaje Nota 3</th>
                                <th>Porcentaje Nota 4</th>
                                <th>Porcentaje Nota 5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="number" step="0.01" name="nota{{ $periodo }}_1" class="form-control"
                                        required></td>
                                <td><input type="number" step="0.01" name="nota{{ $periodo }}_2"
                                        class="form-control" required></td>
                                <td><input type="number" step="0.01" name="nota{{ $periodo }}_3"
                                        class="form-control" required></td>
                                <td><input type="number" step="0.01" name="nota{{ $periodo }}_4"
                                        class="form-control" required></td>
                                <td><input type="number" step="0.01" name="nota{{ $periodo }}_5"
                                        class="form-control" required></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota{{ $periodo }}_1"
                                        class="form-control" value="20.00" required></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota{{ $periodo }}_2"
                                        class="form-control" value="20.00" required></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota{{ $periodo }}_3"
                                        class="form-control" value="20.00" required></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota{{ $periodo }}_4"
                                        class="form-control" value="20.00" required></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota{{ $periodo }}_5"
                                        class="form-control" value="20.00" required></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endfor

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Guardar Notas</button>
            </div>
        </form>
    </div>
@endsection
