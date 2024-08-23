<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstadisticasController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta de inicio para todos los usuarios
Route::get('/home', function () {
    if (Auth::check()) {
        if (Auth::user()->rol == 'Alumno') {
            return redirect()->route('alumno.materias');
        } elseif (Auth::user()->rol == 'Docente') {
            return redirect()->route('docente.materias');
        } elseif (Auth::user()->rol == 'Superadmin') {
            return view('home'); // Aquí podrías cargar un dashboard para Superadmin
        }
    }
    return view('welcome'); // Redirige a welcome si no hay un rol definido
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas protegidas
Route::middleware('auth')->group(function() {
    Route::get('/register', [SuperadminController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [SuperadminController::class, 'register']);

    Route::get('/materias', [SuperadminController::class, 'showMateriasForm'])->name('materias');
    Route::post('/materias', [SuperadminController::class, 'asignarMaterias']);

   
    // Docente
Route::get('/materias/docente', [DocenteController::class, 'verMaterias'])->name('docente.materias');
Route::get('/materias/docente/{id}', [DocenteController::class, 'verAlumnos'])->name('docente.alumnos');
Route::get('/materias/docente/{id}/notas/{alumno_id}', [DocenteController::class, 'verNotasAlumno'])->name('docente.ver.notas');
Route::get('/materias/docente/{id}/notasalumno/{alumno_id}', [DocenteController::class, 'NotasAlumno'])->name('docente.notas.alumno');
Route::post('/materias/docente/{id}/notas/{alumno_id}', [DocenteController::class, 'guardarNotas'])->name('docente.notas.guardar');

// Alumno
Route::get('/materias/alumno', [AlumnoController::class, 'verMaterias'])->name('alumno.materias');
Route::get('/materias/alumno/{id}', [AlumnoController::class, 'verNotas'])->name('alumno.notas');
Route::get('/alumno/imprimir/{materia_id}/{periodo}', [AlumnoController::class, 'imprimirNotasPeriodo'])->name('alumno.imprimir');
Route::get('/materias/alumno/{id}/historial', [AlumnoController::class, 'verHistorial'])->name('alumno.historial');



    // Ruta para estadísticas
    Route::get('/estadisticas', [EstadisticasController::class, 'index'])->name('estadisticas');
});