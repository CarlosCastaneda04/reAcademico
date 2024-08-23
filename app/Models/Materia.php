<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    // Definir la tabla asociada al modelo
    protected $table = 'materias';

    // Indicar los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'docente_id',
        'carrera_id'
    ];

    // Relación con el modelo User para obtener el docente que imparte la materia
    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    // Relación con el modelo Carrera
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    // Relación con el modelo Matricula para obtener los alumnos matriculados en la materia
    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'materia_id');
    }
}
