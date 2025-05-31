<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoAsignatura extends Model
{
    protected $table = 'proyectoAsignaturas';

    protected $fillable = [
        'proyectoId',
        'asignaturaId',
        'docenteId',
        'grupo',
        'semestre',
        'año'
    ];

    // Relaciones
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyectoId');
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'asignaturaId');
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docenteId');
    }
}
