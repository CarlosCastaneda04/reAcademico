@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Notas del Alumno</h1>
        <form id="form-notas" action="{{ route('docente.notas.guardar', ['id' => $materia_id, 'alumno_id' => $alumno_id]) }}" method="POST">
            @csrf
            @foreach ($notas as $nota)
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Periodo</th>
                            <th>Evaluación 1 <br>{{ $nota->P1 }}%</th>
                            <th>Evaluación 2 <br>{{ $nota->P2 }}%</th>
                            <th>Evaluación 3 <br>{{ $nota->P3 }}%</th>
                            <th>Evaluación 4 <br>{{ $nota->P4 }}%</th>
                            <th>Evaluación 5 <br>{{ $nota->P5 }}%</th>
                            <th>Nota Final</th>
                            <th>Asistencia (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $nota->periodo }}</td>
                            <td><input type="text" name="nota1[{{ $nota->periodo }}]" value="{{ $nota->{'Evaluación 1'} }}"
                                    class="form-control-sm nota-input"></td>
                            <td><input type="text" name="nota2[{{ $nota->periodo }}]" value="{{ $nota->{'Evaluación 2'} }}"
                                    class="form-control-sm nota-input"></td>
                            <td><input type="text" name="nota3[{{ $nota->periodo }}]" value="{{ $nota->{'Evaluación 3'} }}"
                                    class="form-control-sm nota-input"></td>
                            <td><input type="text" name="nota4[{{ $nota->periodo }}]" value="{{ $nota->{'Evaluación 4'} }}"
                                    class="form-control-sm nota-input"></td>
                            <td><input type="text" name="nota5[{{ $nota->periodo }}]" value="{{ $nota->{'Evaluación 5'} }}"
                                    class="form-control-sm nota-input"></td>
                            <td>{{ $nota->{'Nota Final'} }}</td>
                            <td><input type="text" name="asistencia[{{ $nota->periodo }}]" value="{{ $nota->{'Asistencia (%)'} }}"
                                    class="form-control-sm"></td>
                        </tr>
                        <tr>
                            <td>Porcentaje</td>
                            <td><input type="text" name="porcentaje_nota1" value="{{ $nota->P1 }}"
                                    class="form-control-sm porcentaje"></td>
                            <td><input type="text" name="porcentaje_nota2" value="{{ $nota->P2 }}"
                                    class="form-control-sm porcentaje"></td>
                            <td><input type="text" name="porcentaje_nota3" value="{{ $nota->P3 }}"
                                    class="form-control-sm porcentaje"></td>
                            <td><input type="text" name="porcentaje_nota4" value="{{ $nota->P4 }}"
                                    class="form-control-sm porcentaje"></td>
                            <td><input type="text" name="porcentaje_nota5" value="{{ $nota->P5 }}"
                                    class="form-control-sm porcentaje"></td>
                            <td colspan="2">
                                <p class="suma-porcentajes-msg mt-2 fw-bold"></p>
                            </td>
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

        <!-- Mostrar promedios generales -->
        <div class="mt-4 text-center">
            <h4>Promedio General</h4>
            <p><strong>Nota Final:</strong> {{ $promedioNotas }} / 10</p>
            <p><strong>Asistencia Promedio:</strong> {{ $promedioAsistencias }}%</p>
        </div>

        <div class="volver-btn-container mt-3">
            <button class="volver-btn btn btn-secondary" onclick="window.history.back()">Volver</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-notas');

            // Validar números positivos
            document.querySelectorAll('input[type="text"]').forEach(input => {
                input.addEventListener('input', function () {
                    const value = parseFloat(this.value);
                    if (isNaN(value) || value < 0) {
                        this.value = '';
                        Swal.fire({
                            icon: 'warning',
                            title: 'Valor inválido',
                            text: 'Por favor, ingresa un número positivo.'
                        });
                    }
                });
            });

            // Redondear notas al salir del campo
            document.querySelectorAll('.nota-input').forEach(input => {
                input.addEventListener('blur', function () {
                    const value = parseFloat(this.value);
                    if (!isNaN(value)) {
                        this.value = value.toFixed(2);
                    }
                });
            });

            // Validar suma de porcentajes para cada tabla
            document.querySelectorAll('table').forEach(table => {
                const inputs = table.querySelectorAll('.porcentaje');
                const msg = table.querySelector('.suma-porcentajes-msg');

                function actualizarSuma() {
                    let suma = 0;
                    inputs.forEach(i => suma += parseFloat(i.value) || 0);

                    if (suma === 100) {
                        msg.textContent = '✔ La suma de porcentajes es 100%.';
                        msg.style.color = 'green';
                    } else {
                        msg.textContent = `✘ La suma actual es ${suma}%. Debe ser exactamente 100%.`;
                        msg.style.color = 'red';
                    }

                    return suma;
                }

                inputs.forEach(input => input.addEventListener('input', actualizarSuma));
                actualizarSuma();
            });

            // Validación global al enviar
            form.addEventListener('submit', function (e) {
                let todoOk = true;

                document.querySelectorAll('table').forEach(table => {
                    const inputs = table.querySelectorAll('.porcentaje');
                    let suma = 0;
                    inputs.forEach(i => suma += parseFloat(i.value) || 0);

                    if (suma !== 100) {
                        todoOk = false;
                    }
                });

                if (!todoOk) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en los porcentajes',
                        text: 'Cada tabla de período debe tener una suma de porcentajes igual a 100%.'
                    });
                }
            });

            // Evitar envío por Enter
            form.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') e.preventDefault();
            });
        });
    </script>
@endsection
