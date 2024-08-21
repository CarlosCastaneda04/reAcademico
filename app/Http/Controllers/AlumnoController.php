<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    public function verMaterias()
    {
        $alumno_id = Auth::user()->id;
    
        $materias = DB::select('
            SELECT m.id, m.nombre AS materia
            FROM materias m
            INNER JOIN matriculas ma ON m.id = ma.materia_id
            INNER JOIN usuarios u ON u.id = ma.alumno_id
            WHERE u.id = ? AND ma.estado = ?', [$alumno_id, 'Activo']);
    
        return view('alumno.home', compact('materias'));
    }
    

    public function verNotas($id) {
        $alumno_id = Auth::user()->id;

        // Ejecución de la consulta SQL
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
                u.id = ? AND m.id = ?', [$alumno_id, $id]);

        return view('alumno.notas', compact('notas'));
    }
    

    public function descargarNotas($id) {
        $alumno_id = Auth::user()->id;
        $notas = DB::select('SELECT * FROM notas WHERE matricula_id = (SELECT id FROM matriculas WHERE alumno_id = ? AND materia_id = ?)', [$alumno_id, $id]);

        // Aquí podrías implementar la lógica para descargar las notas en PDF o Excel

        //return response()->download($filePath);
    }
}
