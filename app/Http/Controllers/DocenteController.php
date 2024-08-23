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

        
    
        return view('profesor.vernotas', compact('notas'));
    }

    public function guardarNotas(Request $request, $id) {
        $data = $request->only(['matricula_id', 'nota1', 'nota2', 'nota3', 'nota4', 'nota5', 'porcentaje_nota1', 'porcentaje_nota2', 'porcentaje_nota3', 'porcentaje_nota4', 'porcentaje_nota5']);
        
        DB::update('UPDATE notas SET nota1 = ?, nota2 = ?, nota3 = ?, nota4 = ?, nota5 = ?, porcentaje_nota1 = ?, porcentaje_nota2 = ?, porcentaje_nota3 = ?, porcentaje_nota4 = ?, porcentaje_nota5 = ? WHERE matricula_id = ? AND periodo = ?', [
            $data['nota1'], $data['nota2'], $data['nota3'], $data['nota4'], $data['nota5'], $data['porcentaje_nota1'], $data['porcentaje_nota2'], $data['porcentaje_nota3'], $data['porcentaje_nota4'], $data['porcentaje_nota5'], $data['matricula_id'], $request->input('periodo')
        ]);

        return redirect()->route('docente.alumnos', ['id' => $id]);
    }



}
