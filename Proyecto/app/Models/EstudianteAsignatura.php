<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstudianteAsignatura extends Model
{
    protected $table = 'estudianteAsignaturas';

    protected $fillable = [
        'estudianteId',
        'asignaturaId',
        'semestre',
        'año',
        'grupo',
        'notaFinal',
        'fechaMatricula',
        'estado'
    ];

    protected $dates = [
        'fechaMatricula'
    ];

    protected $casts = [
        'notaFinal' => 'decimal:2'
    ];

    // Relaciones
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudianteId');
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'asignaturaId');
    }

    // Scopes
    public function scopeAprobados($query)
    {
        return $query->where('estado', 'aprobado');
    }

    public function scopePorSemestre($query, $semestre, $año)
    {
        return $query->where('semestre', $semestre)->where('año', $año);
    }
}