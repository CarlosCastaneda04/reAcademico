@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@section('content')
    <div class="container">
        @if (count($notas) > 0)
            <h1 class="text-center">Notas de {{ $notas[0]->materia }}</h1>

            @php
                $periodo1 = null;
                $periodo2 = null;
                $periodo3 = null;
                foreach ($notas as $nota) {
                    if ($nota->periodo == 1) {
                        $periodo1 = $nota;
                    } elseif ($nota->periodo == 2) {
                        $periodo2 = $nota;
                    } elseif ($nota->periodo == 3) {
                        $periodo3 = $nota;
                    }
                }
            @endphp

            <div class="periodo-container">
                <div style="margin-top: 40%"></div>
                {{-- Tabla para el Periodo 1 --}}
                @if ($periodo1)
                    <h2 class="text-center">Notas del Periodo 1</h2>
                    <form
                        action="{{ route('docente.notas.guardar.periodo', ['id' => $materia_id, 'alumno_id' => $alumno_id]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="periodo" value="1">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Evaluación 1 <br>{{ $periodo1->P1 }}(%)</th>
                                    <th>Evaluación 2 <br>{{ $periodo1->P2 }}(%)</th>
                                    <th>Evaluación 3 <br>{{ $periodo1->P3 }}(%)</th>
                                    <th>Evaluación 4 <br>{{ $periodo1->P4 }}(%)</th>
                                    <th>Evaluación 5 <br>{{ $periodo1->P5 }}(%)</th>
                                    <th>Nota Final <br>100(%)</th>
                                    <th>Asistencia (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="nota1" value="{{ $periodo1->{'Evaluación 1'} }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="nota2" value="{{ $periodo1->{'Evaluación 2'} }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="nota3" value="{{ $periodo1->{'Evaluación 3'} }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="nota4" value="{{ $periodo1->{'Evaluación 4'} }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="nota5" value="{{ $periodo1->{'Evaluación 5'} }}"
                                            class="form-control"></td>
                                    <td>{{ $periodo1->{'Nota Final'} }}</td>
                                    <td><input type="text" name="asistencia" value="{{ $periodo1->{'Asistencia (%)'} }}"
                                            class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Porcentaje</td>
                                    <td><input type="text" name="porcentaje_nota1" value="{{ $periodo1->P1 }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="porcentaje_nota2" value="{{ $periodo1->P2 }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="porcentaje_nota3" value="{{ $periodo1->P3 }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="porcentaje_nota4" value="{{ $periodo1->P4 }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="porcentaje_nota5" value="{{ $periodo1->P5 }}"
                                            class="form-control"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Guardar Cambios del Periodo 1</button>
                        </div>
                    </form>
                @endif

                {{-- Tabla para el Periodo 2 --}}
                @if ($periodo2)
                    <h2 class="text-center">Notas del Periodo 2</h2>
                    <form
                        action="{{ route('docente.notas.guardar.periodo', ['id' => $materia_id, 'alumno_id' => $alumno_id]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="periodo" value="2">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Evaluación 1 <br>{{ $periodo2->P1 }}(%)</th>
                                    <th>Evaluación 2 <br>{{ $periodo2->P2 }}(%)</th>
                                    <th>Evaluación 3 <br>{{ $periodo2->P3 }}(%)</th>
                                    <th>Evaluación 4 <br>{{ $periodo2->P4 }}(%)</th>
                                    <th>Evaluación 5 <br>{{ $periodo2->P5 }}(%)</th>
                                    <th>Nota Final <br>100(%)</th>
                                    <th>Asistencia (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="nota1" value="{{ $periodo2->{'Evaluación 1'} }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="nota2" value="{{ $periodo2->{'Evaluación 2'} }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="nota3" value="{{ $periodo2->{'Evaluación 3'} }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="nota4" value="{{ $periodo2->{'Evaluación 4'} }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="nota5" value="{{ $periodo2->{'Evaluación 5'} }}"
                                            class="form-control"></td>
                                    <td>{{ $periodo2->{'Nota Final'} }}</td>
                                    <td><input type="text" name="asistencia" value="{{ $periodo2->{'Asistencia (%)'} }}"
                                            class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Porcentaje</td>
                                    <td><input type="text" name="porcentaje_nota1" value="{{ $periodo2->P1 }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="porcentaje_nota2" value="{{ $periodo2->P2 }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="porcentaje_nota3" value="{{ $periodo2->P3 }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="porcentaje_nota4" value="{{ $periodo2->P4 }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="porcentaje_nota5" value="{{ $periodo2->P5 }}"
                                            class="form-control"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Guardar Cambios del Periodo 2</button>
                        </div>
                    </form>
                @endif

                {{-- Tabla para el Periodo 3 --}}
                @if ($periodo3)
                    <h2 class="text-center">Notas del Periodo 3</h2>
                    <form
                        action="{{ route('docente.notas.guardar.periodo', ['id' => $materia_id, 'alumno_id' => $alumno_id]) }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="periodo" value="3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Evaluación 1 <br>{{ $periodo3->P1 }}(%)</th>
                                    <th>Evaluación 2 <br>{{ $periodo3->P2 }}(%)</th>
                                    <th>Evaluación 3 <br>{{ $periodo3->P3 }}(%)</th>
                                    <th>Evaluación 4 <br>{{ $periodo3->P4 }}(%)</th>
                                    <th>Evaluación 5 <br>{{ $periodo3->P5 }}(%)</th>
                                    <th>Nota Final <br>100(%)</th>
                                    <th>Asistencia (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="nota1" value="{{ $periodo3->{'Evaluación 1'} }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="nota2" value="{{ $periodo3->{'Evaluación 2'} }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="nota3" value="{{ $periodo3->{'Evaluación 3'} }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="nota4" value="{{ $periodo3->{'Evaluación 4'} }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="nota5" value="{{ $periodo3->{'Evaluación 5'} }}"
                                            class="form-control"></td>
                                    <td>{{ $periodo3->{'Nota Final'} }}</td>
                                    <td><input type="text" name="asistencia"
                                            value="{{ $periodo3->{'Asistencia (%)'} }}" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td>Porcentaje</td>
                                    <td><input type="text" name="porcentaje_nota1" value="{{ $periodo3->P1 }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="porcentaje_nota2" value="{{ $periodo3->P2 }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="porcentaje_nota3" value="{{ $periodo3->P3 }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="porcentaje_nota4" value="{{ $periodo3->P4 }}"
                                            class="form-control"></td>
                                    <td><input type="text" name="porcentaje_nota5" value="{{ $periodo3->P5 }}"
                                            class="form-control"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Guardar Cambios del Periodo 3</button>
                        </div>
                    </form>
                @endif
            </div>
        @else
            <p class="text-center">No se encontraron notas para este alumno en esta materia.</p>
        @endif

        <div class="text-center mt-4">
            <button class="btn btn-secondary" onclick="window.history.back()">Volver</button>
        </div>
    </div>
@endsection
