<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   // Asegúrate de importar DB
use Illuminate\Support\Facades\Hash; // Asegúrate de importar Hash

class SuperadminController extends Controller
{
    public function showRegisterForm() {
        return view('superadmin.register');
    }

    public function register(Request $request) {
        $data = $request->only(['nombre', 'email', 'password', 'rol', 'facultad_id', 'carrera_id']);
        $data['password'] = Hash::make($data['password']);

        DB::insert('INSERT INTO usuarios (nombre, email, password, rol, facultad_id, carrera_id) VALUES (?, ?, ?, ?, ?, ?)', [
            $data['nombre'], $data['email'], $data['password'], $data['rol'], $data['facultad_id'], $data['carrera_id']
        ]);

        return redirect()->route('home');
    }

    public function showMateriasForm() {
        $docentes = DB::select('SELECT * FROM usuarios WHERE rol = ?', ['Docente']);
        $carreras = DB::select('SELECT * FROM carreras');

        return view('superadmin.materias', compact('docentes', 'carreras'));
    }

    public function asignarMaterias(Request $request) {
        DB::insert('INSERT INTO materias (nombre, docente_id, carrera_id) VALUES (?, ?, ?)', [
            $request->input('nombre'),
            $request->input('docente_id'),
            $request->input('carrera_id')
        ]);

        return redirect()->route('materias');
    }
}
