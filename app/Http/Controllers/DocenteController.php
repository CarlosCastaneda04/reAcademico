<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Asegúrate de importar Auth
use Illuminate\Support\Facades\DB;   // Asegúrate de importar DB

class DocenteController extends Controller
{
    public function verMaterias() {
        $docente_id = Auth::user()->id;
        $materias = DB::select('SELECT * FROM materias WHERE docente_id = ?', [$docente_id]);

        return view('docente.materias', compact('materias'));
    }

    public function verAlumnos($id) {
        $alumnos = DB::select('SELECT u.* FROM usuarios u JOIN matriculas mt ON u.id = mt.alumno_id WHERE mt.materia_id = ?', [$id]);

        return view('docente.alumnos', compact('alumnos'));
    }

    public function guardarNotas(Request $request, $id) {
        $data = $request->only(['matricula_id', 'nota1', 'nota2', 'nota3', 'nota4', 'nota5', 'porcentaje_nota1', 'porcentaje_nota2', 'porcentaje_nota3', 'porcentaje_nota4', 'porcentaje_nota5']);
        
        DB::update('UPDATE notas SET nota1 = ?, nota2 = ?, nota3 = ?, nota4 = ?, nota5 = ?, porcentaje_nota1 = ?, porcentaje_nota2 = ?, porcentaje_nota3 = ?, porcentaje_nota4 = ?, porcentaje_nota5 = ? WHERE matricula_id = ? AND periodo = ?', [
            $data['nota1'], $data['nota2'], $data['nota3'], $data['nota4'], $data['nota5'], $data['porcentaje_nota1'], $data['porcentaje_nota2'], $data['porcentaje_nota3'], $data['porcentaje_nota4'], $data['porcentaje_nota5'], $data['matricula_id'], $request->input('periodo')
        ]);

        return redirect()->route('docente.alumnos', ['id' => $id]);
    }
}
