@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Notas del Alumno</h1>
        <form action="{{ route('docente.notas.guardar', ['id' => $materia_id, 'alumno_id' => $alumno_id]) }}" method="POST">
            @csrf
            @foreach ($notas as $nota)
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Periodo</th>
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
                            <td>{{ $nota->periodo }}</td>
                            <td><input type="text" name="nota1[{{ $nota->periodo }}]" value="{{ $nota->{"Evaluación 1"} }}"
                                    class="form-control-sm"></td>
                            <td><input type="text" name="nota2[{{ $nota->periodo }}]"
                                    value="{{ $nota->{"Evaluación 2"} }}" class="form-control-sm"></td>
                            <td><input type="text" name="nota3[{{ $nota->periodo }}]"
                                    value="{{ $nota->{"Evaluación 3"} }}" class="form-control-sm"></td>
                            <td><input type="text" name="nota4[{{ $nota->periodo }}]"
                                    value="{{ $nota->{"Evaluación 4"} }}" class="form-control-sm"></td>
                            <td><input type="text" name="nota5[{{ $nota->periodo }}]"
                                    value="{{ $nota->{"Evaluación 5"} }}" class="form-control-sm"></td>
                            <td>{{ $nota->{"Nota Final"} }}</td>
                            <td><input type="text" name="asistencia[{{ $nota->periodo }}]"
                                    value="{{ $nota->{"Asistencia (%)"} }}" class="form-control-sm"></td>
                        </tr>
                        <tr>
                            <td>Porcentaje</td>
                            <td><input type="text" name="porcentaje_nota1" value="{{ $nota->{"P1"} }}"
                                    class="form-control-sm"></td>
                            <td><input type="text" name="porcentaje_nota2" value="{{ $nota->{"P2"} }}"
                                    class="form-control-sm"></td>
                            <td><input type="text" name="porcentaje_nota3" value="{{ $nota->{"P3"} }}"
                                    class="form-control-sm"></td>
                            <td><input type="text" name="porcentaje_nota4" value="{{ $nota->{"P4"} }}"
                                    class="form-control-sm"></td>
                            <td><input type="text" name="porcentaje_nota5" value="{{ $nota->{"P5"} }}"
                                    class="form-control-sm"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="8">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[type="text"]').forEach(input => {
                input.addEventListener('input', function() {
                    const value = parseFloat(this.value);

                    if (isNaN(value) || value < 0) {
                        this.value = '';
                        alert('Por favor, ingresa un número positivo.');
                    }
                });
            });
        });
    </script>
@endsection
