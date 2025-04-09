<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    public function verMaterias()
    {
        $docente_id = Auth::user()->id;
        $materias = DB::select('SELECT * FROM materias WHERE docente_id = ?', [$docente_id]);
        return view('profesor.docmaterias', compact('materias'));
    }

    public function verAlumnos($id)
    {
        $alumnos = DB::select('
            SELECT u.id, u.nombre, u.email, mt.estado
            FROM usuarios u
            JOIN matriculas mt ON u.id = mt.alumno_id
            WHERE mt.materia_id = ?
        ', [$id]);

        return view('profesor.docalumnos', compact('alumnos', 'id'));
    }

    public function verNotasAlumno($materia_id, $alumno_id)
    {
        return $this->NotasAlumno($materia_id, $alumno_id);
    }

    public function NotasAlumno($materia_id, $alumno_id)
    {
        $notasRaw = DB::select('
            SELECT
                n.periodo,
                n.nota1 AS "Evaluación 1",
                n.nota2 AS "Evaluación 2",
                n.nota3 AS "Evaluación 3",
                n.nota4 AS "Evaluación 4",
                n.nota5 AS "Evaluación 5",
                n.porcentaje_nota1 AS "P1",
                n.porcentaje_nota2 AS "P2",
                n.porcentaje_nota3 AS "P3",
                n.porcentaje_nota4 AS "P4",
                n.porcentaje_nota5 AS "P5",
                ROUND((
                    (n.nota1 * n.porcentaje_nota1 / 100) +
                    (n.nota2 * n.porcentaje_nota2 / 100) +
                    (n.nota3 * n.porcentaje_nota3 / 100) +
                    (n.nota4 * n.porcentaje_nota4 / 100) +
                    (n.nota5 * n.porcentaje_nota5 / 100)
                ), 2) AS "Nota Final",
                a.asistencia_porcentaje AS "Asistencia (%)"
            FROM
                notas n
            INNER JOIN
                matriculas ma ON n.matricula_id = ma.id
            LEFT JOIN
                asistencias a ON a.matricula_id = ma.id
            WHERE
                ma.alumno_id = ? AND ma.materia_id = ?
        ', [$alumno_id, $materia_id]);

        $periodosMap = ['1' => 'Periodo 1', '2' => 'Periodo 2', '3' => 'Periodo 3'];

        $notasCollection = collect($notasRaw)->map(function ($nota) use ($periodosMap) {
            $numero = (string) $nota->periodo;
            $nota->periodo = $periodosMap[$numero] ?? "Periodo $numero";
            return $nota;
        })->keyBy('periodo');

        $periodos = ['Periodo 1', 'Periodo 2', 'Periodo 3'];
        $notas = collect();

        foreach ($periodos as $periodo) {
            $nota = $notasCollection->get($periodo) ?? (object)[
                'periodo' => $periodo,
                'Evaluación 1' => null,
                'Evaluación 2' => null,
                'Evaluación 3' => null,
                'Evaluación 4' => null,
                'Evaluación 5' => null,
                'P1' => 20,
                'P2' => 20,
                'P3' => 20,
                'P4' => 20,
                'P5' => 20,
                'Nota Final' => null,
                'Asistencia (%)' => null,
            ];
            $notas->push($nota);
        }

        $promedioNotas = round($notas->whereNotNull('Nota Final')->avg('Nota Final'), 2);
        $promedioAsistencias = round($notas->whereNotNull('Asistencia (%)')->avg('Asistencia (%)'), 2);

        return view('profesor.vernotas', compact('notas', 'materia_id', 'alumno_id', 'promedioNotas', 'promedioAsistencias'));
    }

    public function guardarNotas(Request $request, $materia_id, $alumno_id)
    {
        $periodos = array_keys($request->input('nota1'));
        $matricula = DB::table('matriculas')
            ->where('materia_id', $materia_id)
            ->where('alumno_id', $alumno_id)
            ->first();

        if (!$matricula) {
            return back()->with('error', 'No se encontró la matrícula.');
        }

        foreach ($periodos as $periodo) {

            $periodoNumero = (int) filter_var($periodo, FILTER_SANITIZE_NUMBER_INT);

            $request->validate([
                "nota1.$periodo" => 'required|numeric|min:0|max:10',
                "nota2.$periodo" => 'required|numeric|min:0|max:10',
                "nota3.$periodo" => 'required|numeric|min:0|max:10',
                "nota4.$periodo" => 'required|numeric|min:0|max:10',
                "nota5.$periodo" => 'required|numeric|min:0|max:10',
                'porcentaje_nota1' => 'required|numeric|min:0|max:100',
                'porcentaje_nota2' => 'required|numeric|min:0|max:100',
                'porcentaje_nota3' => 'required|numeric|min:0|max:100',
                'porcentaje_nota4' => 'required|numeric|min:0|max:100',
                'porcentaje_nota5' => 'required|numeric|min:0|max:100',
                "asistencia.$periodo" => 'required|numeric|min:0|max:100'
            ]);

            $notaExistente = DB::table('notas')
                ->where('matricula_id', $matricula->id)
                ->where('periodo', $periodoNumero)
                ->first();

            $dataNotas = [
                'matricula_id' => $matricula->id,
                'periodo' => $periodoNumero,
                'nota1' => $request->input("nota1.$periodo"),
                'nota2' => $request->input("nota2.$periodo"),
                'nota3' => $request->input("nota3.$periodo"),
                'nota4' => $request->input("nota4.$periodo"),
                'nota5' => $request->input("nota5.$periodo"),
                'porcentaje_nota1' => $request->input('porcentaje_nota1'),
                'porcentaje_nota2' => $request->input('porcentaje_nota2'),
                'porcentaje_nota3' => $request->input('porcentaje_nota3'),
                'porcentaje_nota4' => $request->input('porcentaje_nota4'),
                'porcentaje_nota5' => $request->input('porcentaje_nota5'),
            ];

            if ($notaExistente) {
                DB::table('notas')->where('id', $notaExistente->id)->update($dataNotas);
            } else {
                DB::table('notas')->insert($dataNotas);
            }

            DB::table('asistencias')->updateOrInsert(
                ['matricula_id' => $matricula->id],
                ['asistencia_porcentaje' => $request->input("asistencia.$periodo")]
            );
        }

        return redirect()->route('docente.alumnos', ['id' => $materia_id])->with('success', 'Notas y asistencias guardadas correctamente.');
    }
}
