<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    // Definir la tabla asociada al modelo
    protected $table = 'asistencias';

    // Indicar los campos que pueden ser asignados masivamente
    protected $fillable = [
        'matricula_id',
        'asistencia_porcentaje'
    ];

    // Relación con el modelo Matricula
    public function matricula()
    {
        return $this->belongsTo(Matricula::class, 'matricula_id');
    }
}
