<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    // Definir la tabla asociada al modelo
    protected $table = 'carreras';

    // Indicar los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre',
        'facultad_id'
    ];

    // Relación con el modelo Facultad
    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'facultad_id');
    }

    // Relación con el modelo Materia
    public function materias()
    {
        return $this->hasMany(Materia::class, 'carrera_id');
    }

    // Relación con el modelo User para obtener los alumnos que pertenecen a la carrera
    public function alumnos()
    {
        return $this->hasMany(User::class, 'carrera_id')->where('rol', 'Alumno');
    }
}
