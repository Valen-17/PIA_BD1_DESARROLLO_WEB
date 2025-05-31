<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'identificacion',
        'nombres',
        'apellidos',
        'email',
        'telefono',
        'programaId'
    ];

    // Relaciones
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programaId');
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'estudianteAsignaturas', 'estudianteId', 'asignaturaId')
                    ->withPivot('semestre', 'año', 'grupo', 'notaFinal', 'fechaMatricula', 'estado')
                    ->withTimestamps();
    }

     // Accessor para nombre completo
    public function getNombreCompletoAttribute()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }
}