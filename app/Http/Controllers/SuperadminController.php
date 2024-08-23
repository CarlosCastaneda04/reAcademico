<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    // Mostrar la lista de docentes
    public function verDocentes()
    {
        $docentes = DB::select('SELECT * FROM usuarios WHERE rol = ?', ['Docente']);
        return view('superadmin.docentes', compact('docentes'));
    }

    // Mostrar el formulario para crear una nueva materia
public function crearMateriaForm()
{
    $docentes = DB::select('SELECT * FROM usuarios WHERE rol = ?', ['Docente']);
    $alumnos = DB::select('SELECT * FROM usuarios WHERE rol = ?', ['Alumno']);
    $carreras = DB::select('SELECT * FROM carreras');

    return view('superadmin.crearMateria', compact('docentes', 'alumnos', 'carreras'));
}


    // Guardar la nueva materia y asignar docente y alumnos
public function crearMateria(Request $request)
{
    // Insertar la nueva materia
    DB::insert('INSERT INTO materias (nombre, docente_id, carrera_id) VALUES (?, ?, ?)', [
        $request->input('nombre'),
        $request->input('docente_id'),
        $request->input('carrera_id')
    ]);

    // Obtener el ID de la materia recién creada
    $materia_id = DB::getPdo()->lastInsertId();

    // Matricular los alumnos en la nueva materia
    $alumnos_ids = $request->input('alumnos', []);
    foreach ($alumnos_ids as $alumno_id) {
        DB::insert('INSERT INTO matriculas (alumno_id, materia_id, estado) VALUES (?, ?, ?)', [
            $alumno_id,
            $materia_id,
            'Activo'
        ]);
    }

    // Redirigir a la página que muestra todas las materias
    return redirect()->route('superadmin.materias.index')->with('success', 'Materia creada y alumnos matriculados exitosamente.');
}
public function verMateriasPorDocente($docente_id)
{
    $docente = DB::select('SELECT * FROM usuarios WHERE id = ? AND rol = ?', [$docente_id, 'Docente']);
    
    if (empty($docente)) {
        return redirect()->route('superadmin.docentes')->with('error', 'Docente no encontrado.');
    }

    $materias = DB::select('SELECT * FROM materias WHERE docente_id = ?', [$docente_id]);

    return view('superadmin.verMateriasPorDocente', compact('docente', 'materias'));
}


public function verMaterias()
{
    $materias = DB::select('
        SELECT materias.*, usuarios.nombre as docente_nombre 
        FROM materias 
        JOIN usuarios ON materias.docente_id = usuarios.id
    ');

    return view('superadmin.verMaterias', compact('materias'));
}

    public function agregarAlumnos(Request $request, $materia_id)
{
    $alumno_id = $request->input('alumno_id');

    // Verificar si el alumno ya está matriculado en la materia
    $existe = DB::table('matriculas')
                ->where('materia_id', $materia_id)
                ->where('alumno_id', $alumno_id)
                ->exists();

    if (!$existe) {
        // Insertar el alumno en la tabla 'matriculas'
        DB::insert('INSERT INTO matriculas (alumno_id, materia_id, estado) VALUES (?, ?, ?)', [
            $alumno_id,
            $materia_id,
            'Activo'
        ]);

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'El alumno ya está matriculado en esta materia.']);
}


    public function verMateriaDetalle($materia_id)
    {
        $materia = DB::select('
            SELECT materias.*, usuarios.nombre as docente_nombre 
            FROM materias 
            JOIN usuarios ON materias.docente_id = usuarios.id
            WHERE materias.id = ?
        ', [$materia_id]);

        $alumnos = DB::select('
            SELECT matriculas.*, usuarios.nombre as alumno_nombre 
            FROM matriculas 
            JOIN usuarios ON matriculas.alumno_id = usuarios.id
            WHERE matriculas.materia_id = ?
        ', [$materia_id]);

        $activos = DB::table('matriculas')
                    ->where('materia_id', $materia_id)
                    ->where('estado', 'Activo')
                    ->count();

        $retirados = DB::table('matriculas')
                    ->where('materia_id', $materia_id)
                    ->where('estado', 'Retirado')
                    ->count();

        // Obtenemos la lista de todas las carreras
        $carreras = DB::select('SELECT * FROM carreras');

        // Obtenemos todos los alumnos disponibles para agregar
        $todosLosAlumnos = DB::select('SELECT * FROM usuarios WHERE rol = ?', ['Alumno']);

        // Extraemos los IDs de los alumnos ya matriculados
        $alumnosSeleccionados = DB::table('matriculas')
            ->where('materia_id', $materia_id)
            ->pluck('alumno_id')
            ->toArray();

        return view('superadmin.verMateriaDetalle', compact('materia', 'alumnos', 'activos', 'retirados', 'carreras', 'todosLosAlumnos', 'alumnosSeleccionados'));
    }


public function actualizarEstadoMatricula(Request $request, $materia_id, $alumno_id)
{
    DB::update('UPDATE matriculas SET estado = ? WHERE materia_id = ? AND alumno_id = ?', [
        $request->input('estado'),
        $materia_id,
        $alumno_id
    ]);

    return redirect()->route('superadmin.materias.detalle', $materia_id)->with('success', 'Estado del alumno actualizado.');
}

    // Mostrar el formulario para dar de baja a un alumno en una materia
    public function darBajaAlumnoForm()
    {
        $materias = DB::select('SELECT * FROM materias');
        return view('superadmin.darBajaAlumno', compact('materias'));
    }

    // Actualizar el estado de un alumno en una materia a 'Retirado' o 'Activo'
    public function darBajaAlumno(Request $request)
    {
        $matricula = DB::select('SELECT * FROM matriculas WHERE materia_id = ? AND alumno_id = ?', [
            $request->input('materia_id'),
            $request->input('alumno_id')
        ]);

        if (!empty($matricula)) {
            DB::update('UPDATE matriculas SET estado = ? WHERE materia_id = ? AND alumno_id = ?', [
                $request->input('estado'),
                $request->input('materia_id'),
                $request->input('alumno_id')
            ]);
            return redirect()->route('superadmin.alumnos.baja')->with('success', 'Estado del alumno actualizado.');
        }

        return redirect()->route('superadmin.alumnos.baja')->with('error', 'No se encontró la matrícula.');
    }
}
