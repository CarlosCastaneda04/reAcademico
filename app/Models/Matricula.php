<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    // Definir la tabla asociada al modelo
    protected $table = 'matriculas';

    // Indicar los campos que pueden ser asignados masivamente
    protected $fillable = [
        'alumno_id',
        'materia_id',
        'estado'
    ];

    // Relación con el modelo User para obtener el alumno relacionado con la matrícula
    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    // Relación con el modelo Materia
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    // Relación con el modelo Nota para obtener las notas del alumno en la materia
    public function notas()
    {
        return $this->hasMany(Nota::class, 'matricula_id');
    }

    // Relación con el modelo Asistencia para obtener la asistencia del alumno en la materia
    public function asistencia()
    {
        return $this->hasOne(Asistencia::class, 'matricula_id');
    }
}
