<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    public function index()
    {
        // Aquí puedes agregar la lógica para mostrar las estadísticas
        return view('estadisticas.index');
    }
}
