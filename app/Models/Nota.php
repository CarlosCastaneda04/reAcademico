<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    // Definir la tabla asociada al modelo
    protected $table = 'notas';

    // Indicar los campos que pueden ser asignados masivamente
    protected $fillable = [
        'matricula_id',
        'periodo',
        'nota1',
        'nota2',
        'nota3',
        'nota4',
        'nota5',
        'porcentaje_nota1',
        'porcentaje_nota2',
        'porcentaje_nota3',
        'porcentaje_nota4',
        'porcentaje_nota5'
    ];

    // Relación con el modelo Matricula
    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id');
    }

    // Método para calcular el promedio ponderado de las notas
    public function calcularPromedio()
    {
        $totalPonderado = ($this->nota1 * $this->porcentaje_nota1) +
                          ($this->nota2 * $this->porcentaje_nota2) +
                          ($this->nota3 * $this->porcentaje_nota3) +
                          ($this->nota4 * $this->porcentaje_nota4) +
                          ($this->nota5 * $this->porcentaje_nota5);

        $totalPorcentajes = $this->porcentaje_nota1 + $this->porcentaje_nota2 + $this->porcentaje_nota3 + $this->porcentaje_nota4 + $this->porcentaje_nota5;

        return $totalPonderado / $totalPorcentajes;
    }
}
