<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocenteAsignatura extends Model
{
    protected $table = 'docenteAsignaturas';

    protected $fillable = [
        'docenteId',
        'asignaturaId',
        'fechaAsignacion',
        'activo'
    ];

    protected $dates = [
        'fechaAsignacion'
    ];

    protected $casts = [
        'activo' => 'boolean'
    ];

    // Relaciones
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docenteId');
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'asignaturaId');
    }
}
