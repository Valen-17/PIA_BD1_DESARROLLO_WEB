<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $table = 'asignaturas';

    protected $fillable = [
        'descripcion',
        'creditos',
        'programaId'
    ];

    // Relaciones
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programaId');
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'docenteAsignaturas', 'asignaturaId', 'docenteId')
                    ->withPivot('fechaAsignacion', 'activo')
                    ->withTimestamps();
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'estudianteAsignaturas', 'asignaturaId', 'estudianteId')
                    ->withPivot('semestre', 'año', 'grupo', 'notaFinal', 'fechaMatricula', 'estado')
                    ->withTimestamps();
    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'proyectoAsignaturas', 'asignaturaId', 'proyectoId')
                    ->withPivot('docenteId', 'grupo', 'semestre', 'año')
                    ->withTimestamps();
    }
}