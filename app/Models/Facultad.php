<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    // Definir la tabla asociada al modelo
    protected $table = 'facultades';

    // Indicar los campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombre'
    ];

    // Relación con el modelo Carrera
    public function carreras()
    {
        return $this->hasMany(Carrera::class, 'facultad_id');
    }

    // Relación con el modelo User para obtener los docentes asociados a la facultad
    public function docentes()
    {
        return $this->hasMany(User::class, 'facultad_id')->where('rol', 'Docente');
    }
}
