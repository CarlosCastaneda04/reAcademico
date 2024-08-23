<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    public function verMaterias() {
        $docente_id = Auth::user()->id;
        $materias = DB::select('SELECT * FROM materias WHERE docente_id = ?', [$docente_id]);
    
        return view('profesor.docmaterias', compact('materias'));
    }

    public function verAlumnos($id) {
        $alumnos = DB::select('
            SELECT u.id, u.nombre, u.email, mt.estado
            FROM usuarios u
            JOIN matriculas mt ON u.id = mt.alumno_id
            WHERE mt.materia_id = ?
        ', [$id]);
    
        return view('profesor.docalumnos', compact('alumnos', 'id'));
    }
    


    public function verNotasAlumno($materia_id, $alumno_id) {
    $notas = DB::select('
        SELECT 
            m.nombre AS materia,
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
        INNER JOIN 
            materias m ON ma.materia_id = m.id
        INNER JOIN 
            usuarios u ON ma.alumno_id = u.id
        LEFT JOIN 
            asistencias a ON a.matricula_id = ma.id
        WHERE 
            u.id = ? AND m.id = ?', [$alumno_id, $materia_id]);

    if (empty($notas)) {
        return view('profesor.no_notas', ['id' => $materia_id]); // o ['id' => $id] según tu variable
    }

    return view('profesor.vernotas', compact('notas', 'materia_id', 'alumno_id'));
    }


     public function NotasAlumno($materia_id, $alumno_id) {
    $notas = DB::select('
        SELECT 
            m.nombre AS materia,
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
        INNER JOIN 
            materias m ON ma.materia_id = m.id
        INNER JOIN 
            usuarios u ON ma.alumno_id = u.id
        LEFT JOIN 
            asistencias a ON a.matricula_id = ma.id
        WHERE 
            u.id = ? AND m.id = ?', [$alumno_id, $materia_id]);

    if (empty($notas)) {
        return view('profesor.no_notas', ['id' => $materia_id]); // o ['id' => $id] según tu variable
    }

    return view('profesor.notasver', compact('notas', 'materia_id', 'alumno_id'));
    }


   public function guardarNotas(Request $request, $materia_id, $alumno_id) {
    $periodos = array_keys($request->input('nota1'));

    foreach ($periodos as $periodo) {
        // Validación de las notas y porcentajes para asegurarse de que son numéricos y están en el rango permitido
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
            "asistencia.$periodo" => 'nullable|numeric|min:0|max:100'
        ]);

        DB::update('UPDATE notas SET 
            nota1 = ?, 
            nota2 = ?, 
            nota3 = ?, 
            nota4 = ?, 
            nota5 = ?, 
            porcentaje_nota1 = ?, 
            porcentaje_nota2 = ?, 
            porcentaje_nota3 = ?, 
            porcentaje_nota4 = ?, 
            porcentaje_nota5 = ? 
            WHERE matricula_id = (SELECT id FROM matriculas WHERE alumno_id = ? AND materia_id = ?) AND periodo = ?', [
            $request->input("nota1.$periodo"), 
            $request->input("nota2.$periodo"), 
            $request->input("nota3.$periodo"), 
            $request->input("nota4.$periodo"), 
            $request->input("nota5.$periodo"),
            $request->input('porcentaje_nota1'), 
            $request->input('porcentaje_nota2'), 
            $request->input('porcentaje_nota3'), 
            $request->input('porcentaje_nota4'), 
            $request->input('porcentaje_nota5'),
            $alumno_id, $materia_id, $periodo
        ]);

        // Actualizar asistencia si está presente
        if ($request->has("asistencia.$periodo")) {
            DB::update('UPDATE asistencias SET asistencia_porcentaje = ? WHERE matricula_id = (SELECT id FROM matriculas WHERE alumno_id = ? AND materia_id = ?)', [
                $request->input("asistencia.$periodo"), $alumno_id, $materia_id
            ]);
        }
    }

    return redirect()->route('docente.alumnos', ['id' => $materia_id])->with('success', 'Notas y porcentajes actualizados correctamente');
}

 // Mostrar el formulario para agregar notas
    public function mostrarFormularioAgregarNotas($id, $alumno_id)
    {
        $matricula = DB::select('SELECT * FROM matriculas WHERE alumno_id = ? AND materia_id = ?', [$alumno_id, $id]);

        if (empty($matricula)) {
            return redirect()->back()->with('error', 'Matrícula no encontrada.');
        }

        $matricula_id = $matricula[0]->id;

        $notas = DB::select('SELECT * FROM notas WHERE matricula_id = ?', [$matricula_id]);

        return view('profesor.agregarNotas', compact('id', 'alumno_id', 'notas', 'matricula_id'));
    }

   
    
public function guardarNotasd(Request $request, $id, $alumno_id, $periodo)
{
    $matricula_id = $request->input('matricula_id');

    // Verificar si ya existe un registro de notas para el periodo y la matrícula
    $existingNotas = DB::select('SELECT * FROM notas WHERE matricula_id = ? AND periodo = ?', [$matricula_id, $periodo]);

    if ($existingNotas) {
        // Actualizar las notas existentes
        DB::update('UPDATE notas SET 
            nota1 = ?, 
            nota2 = ?, 
            nota3 = ?, 
            nota4 = ?, 
            nota5 = ?, 
            porcentaje_nota1 = ?, 
            porcentaje_nota2 = ?, 
            porcentaje_nota3 = ?, 
            porcentaje_nota4 = ?, 
            porcentaje_nota5 = ? 
            WHERE matricula_id = ? AND periodo = ?', [
            $request->input("nota1") ?? null,
            $request->input("nota2") ?? null,
            $request->input("nota3") ?? null,
            $request->input("nota4") ?? null,
            $request->input("nota5") ?? null,
            $request->input("porcentaje_nota1") ?? 0,
            $request->input("porcentaje_nota2") ?? 0,
            $request->input("porcentaje_nota3") ?? 0,
            $request->input("porcentaje_nota4") ?? 0,
            $request->input("porcentaje_nota5") ?? 0,
            $matricula_id,
            $periodo
        ]);
    } else {
        // Insertar nuevas notas si no existen
        DB::insert('INSERT INTO notas (matricula_id, periodo, nota1, nota2, nota3, nota4, nota5, porcentaje_nota1, porcentaje_nota2, porcentaje_nota3, porcentaje_nota4, porcentaje_nota5)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $matricula_id,
            $periodo,
            $request->input("nota1") ?? null,
            $request->input("nota2") ?? null,
            $request->input("nota3") ?? null,
            $request->input("nota4") ?? null,
            $request->input("nota5") ?? null,
            $request->input("porcentaje_nota1") ?? 0,
            $request->input("porcentaje_nota2") ?? 0,
            $request->input("porcentaje_nota3") ?? 0,
            $request->input("porcentaje_nota4") ?? 0,
            $request->input("porcentaje_nota5") ?? 0,
        ]);
    }

    // Verificar si ya existe un registro de asistencia para la matrícula
    $existingAsistencia = DB::select('SELECT * FROM asistencias WHERE matricula_id = ?', [$matricula_id]);

    if ($request->has('asistencia')) {
        if ($existingAsistencia) {
            // Actualizar la asistencia existente
            DB::update('UPDATE asistencias SET asistencia_porcentaje = ? WHERE matricula_id = ?', [
                $request->input('asistencia'),
                $matricula_id,
            ]);
        } else {
            // Insertar nueva asistencia si no existe
            DB::insert('INSERT INTO asistencias (matricula_id, asistencia_porcentaje) VALUES (?, ?)', [
                $matricula_id,
                $request->input('asistencia'),
            ]);
        }
    }

    return redirect()->route('docente.materias')->with('success', 'Notas y asistencia del periodo guardadas exitosamente.');
}





}
