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
        $notas = DB::select('SELECT * FROM notas WHERE matricula_id = (SELECT id FROM matriculas WHERE alumno_id = ? AND materia_id = ?)', [$alumno_id, $id]);

        return view('alumno.notas', compact('notas'));
    }

    public function descargarNotas($id) {
        $alumno_id = Auth::user()->id;
        $notas = DB::select('SELECT * FROM notas WHERE matricula_id = (SELECT id FROM matriculas WHERE alumno_id = ? AND materia_id = ?)', [$alumno_id, $id]);

        // Aquí podrías implementar la lógica para descargar las notas en PDF o Excel

        //return response()->download($filePath);
    }
}
