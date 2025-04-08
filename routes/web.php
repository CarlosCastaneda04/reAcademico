<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\IpVerificationController;

Route::get('/verify-ip/{user}/{ip}', [IpVerificationController::class, 'verify'])->name('ip.verify');

Route::get('/verificacion-ip-espera', function () {
    return view('auth.espera');
})->name('ip.verification.wait');

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/verify-ip/{user}/{ip}', [IpVerificationController::class, 'verify'])->name('ip.verify');

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

    //
    
Route::middleware('auth')->group(function() {
    Route::get('/materias', [SuperadminController::class, 'showMateriasForm'])->name('materias');
    Route::post('/materias', [SuperadminController::class, 'asignarMaterias']);
    // web.php
Route::get('/registro', [RegistroController::class, 'index'])->name('registro.index');

    Route::post('/superadmin/materias/{id}/agregar-alumnos', [SuperAdminController::class, 'agregarAlumnos'])->name('superadmin.materias.agregarAlumnos');
    // Rutas para Superadmin sin protección por middleware
Route::get('/superadmin/materias/alumnos', [SuperAdminController::class, 'getAlumnosPorCarrera'])->name('superadmin.materias.alumnos');
    Route::get('/superadmin/materias/creati', [SuperAdminController::class, 'crearMateriaForm'])->name('crear');
    Route::get('/superadmin/docentes', [SuperAdminController::class, 'verDocentes'])->name('superadmin.docentes');
    Route::get('/superadmin/docentes/{docente_id}/materias', [SuperAdminController::class, 'verMateriasPorDocente'])->name('superadmin.docentes.materias');
    Route::get('/superadmin/materias/create', [SuperAdminController::class, 'crearMateriaForm'])->name('superadmin.materias.create');
    Route::post('/superadmin/materias/store', [SuperAdminController::class, 'crearMateria'])->name('superadmin.materias.store');
    Route::get('/superadmin/materias', [SuperAdminController::class, 'verMaterias'])->name('superadmin.materias.index');
    Route::get('/superadmin/materias/{materia_id}', [SuperAdminController::class, 'verMateriaDetalle'])->name('superadmin.materias.detalle');
    Route::post('/superadmin/materias/{materia_id}/{alumno_id}/actualizar', [SuperAdminController::class, 'actualizarEstadoMatricula'])->name('superadmin.materias.actualizarEstado');
    Route::get('/superadmin/docentes', [SuperAdminController::class, 'verDocentes'])->name('superadmin.docentes');
    Route::get('/superadmin/materias/create', [SuperAdminController::class, 'crearMateriaForm'])->name('superadmin.materias.create');
    Route::post('/superadmin/materias', [SuperAdminController::class, 'crearMateria'])->name('superadmin.materias.store');
    Route::get('/superadmin/alumnos/baja', [SuperAdminController::class, 'darBajaAlumnoForm'])->name('superadmin.alumnos.baja');
    Route::post('/superadmin/alumnos/baja', [SuperAdminController::class, 'darBajaAlumno'])->name('superadmin.alumnos.baja.store');
    // Rutas para los formularios de registro
Route::get('/registro/alumno', [RegistroController::class, 'mostrarFormularioAlumno'])->name('formulario.alumno');
Route::get('/registro/docente', [RegistroController::class, 'mostrarFormularioDocente'])->name('formulario.docente');
Route::get('/registro/superadmin', [RegistroController::class, 'mostrarFormularioSuperadmin'])->name('formulario.superadmin');


// Rutas para procesar los formularios de registro
Route::post('/registro/alumno', [RegistroController::class, 'registrarAlumno'])->name('registro.alumno');
Route::post('/registro/docente', [RegistroController::class, 'registrarDocente'])->name('registro.docente');
Route::post('/registro/superadmin', [RegistroController::class, 'registrarSuperadmin'])->name('registro.superadmin');
});
   
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


    // Ruta para estadísticas
    Route::get('/estadisticas', [EstadisticasController::class, 'index'])->name('estadisticas');
});