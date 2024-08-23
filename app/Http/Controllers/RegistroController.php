<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\UsuarioCreadoMailable;

class RegistroController extends Controller
{
    public function mostrarFormularioAlumno()
    {
        $facultades = DB::select('SELECT * FROM facultades');
        $carreras = DB::select('SELECT * FROM carreras');
        return view('registro.alumno', compact('facultades', 'carreras'));
    }

    public function mostrarFormularioDocente()
    {
        $facultades = DB::select('SELECT * FROM facultades');
        return view('registro.docente', compact('facultades'));
    }

    public function mostrarFormularioSuperadmin()
    {
        return view('registro.superadmin');
    }

    public function registrarAlumno(Request $request)
    {
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $password = $request->input('password'); // No hashear la contraseña
        $rol = 'Alumno';
        $facultad_id = $request->input('facultad_id');
        $carrera_id = $request->input('carrera_id');

        DB::insert('INSERT INTO usuarios (nombre, email, password, rol, facultad_id, carrera_id) VALUES (?, ?, ?, ?, ?, ?)', [
            $nombre,
            $email,
            $password,
            $rol,
            $facultad_id,
            $carrera_id
        ]);

        // Enviar el correo de bienvenida
        Mail::to($email)->send(new UsuarioCreadoMailable($nombre,$email, $rol));

        return redirect()->route('home')->with('success', 'Alumno registrado exitosamente.');
    }

    public function registrarDocente(Request $request)
    {
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $password = $request->input('password'); // No hashear la contraseña
        $rol = 'Docente';
        $facultad_id = $request->input('facultad_id');

        DB::insert('INSERT INTO usuarios (nombre, email, password, rol, facultad_id) VALUES (?, ?, ?, ?, ?)', [
            $nombre,
            $email,
            $password,
            $rol,
            $facultad_id
        ]);

        // Enviar el correo de bienvenida
        Mail::to($email)->send(new UsuarioCreadoMailable($nombre,$email, $rol));

        return redirect()->route('home')->with('success', 'Docente registrado exitosamente.');
    }

    public function registrarSuperadmin(Request $request)
    {
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $password = $request->input('password'); // No hashear la contraseña
        $rol = 'Superadmin';

        DB::insert('INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)', [
            $nombre,
            $email,
            $password,
            $rol
        ]);

        // Enviar el correo de bienvenida
        Mail::to($email)->send(new UsuarioCreadoMailable($nombre,$email, $rol));

        return redirect()->route('home')->with('success', 'Superadmin registrado exitosamente.');
    }
}
