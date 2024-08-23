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

        .form-group {
            margin-bottom: 2rem;
        }
    </style>

    <div class="container">
        <h2>Agregar Notas y Asistencia</h2>

        <!-- Tabla para Periodo 1 -->
        <div class="form-group">
            <h3>Periodo 1</h3>
            <form action="{{ route('docente.guardar.notas', ['id' => $id, 'alumno_id' => $alumno_id, 'periodo' => 1]) }}"
                method="POST">
                @csrf
                <input type="hidden" name="matricula_id" value="{{ $matricula_id }}">
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
                                <th>Asistencia (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="number" step="0.01" name="nota1" class="form-control"></td>
                                <td><input type="number" step="0.01" name="nota2" class="form-control"></td>
                                <td><input type="number" step="0.01" name="nota3" class="form-control"></td>
                                <td><input type="number" step="0.01" name="nota4" class="form-control"></td>
                                <td><input type="number" step="0.01" name="nota5" class="form-control"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota1" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota2" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota3" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota4" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota5" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="asistencia" class="form-control"
                                        value="100.00"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Notas y Asistencia del Periodo 1</button>
            </form>
        </div>

        <!-- Tabla para Periodo 2 -->
        <div class="form-group">
            <h3>Periodo 2</h3>
            <form action="{{ route('docente.guardar.notas', ['id' => $id, 'alumno_id' => $alumno_id, 'periodo' => 2]) }}"
                method="POST">
                @csrf
                <input type="hidden" name="matricula_id" value="{{ $matricula_id }}">
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
                                <th>Asistencia (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="number" step="0.01" name="nota1" class="form-control"></td>
                                <td><input type="number" step="0.01" name="nota2" class="form-control"></td>
                                <td><input type="number" step="0.01" name="nota3" class="form-control"></td>
                                <td><input type="number" step="0.01" name="nota4" class="form-control"></td>
                                <td><input type="number" step="0.01" name="nota5" class="form-control"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota1" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota2" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota3" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota4" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota5" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="asistencia" class="form-control"
                                        value="100.00"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Notas y Asistencia del Periodo 2</button>
            </form>
        </div>

        <!-- Tabla para Periodo 3 -->
        <div class="form-group">
            <h3>Periodo 3</h3>
            <form action="{{ route('docente.guardar.notas', ['id' => $id, 'alumno_id' => $alumno_id, 'periodo' => 3]) }}"
                method="POST">
                @csrf
                <input type="hidden" name="matricula_id" value="{{ $matricula_id }}">
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
                                <th>Asistencia (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="number" step="0.01" name="nota1" class="form-control"></td>
                                <td><input type="number" step="0.01" name="nota2" class="form-control"></td>
                                <td><input type="number" step="0.01" name="nota3" class="form-control"></td>
                                <td><input type="number" step="0.01" name="nota4" class="form-control"></td>
                                <td><input type="number" step="0.01" name="nota5" class="form-control"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota1" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota2" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota3" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota4" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="porcentaje_nota5" class="form-control"
                                        value="20.00"></td>
                                <td><input type="number" step="0.01" name="asistencia" class="form-control"
                                        value="100.00"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Notas y Asistencia del Periodo 3</button>
            </form>
        </div>
    </div>
@endsection
