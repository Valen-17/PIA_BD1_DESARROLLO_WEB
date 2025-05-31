<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docentes';

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
        return $this->belongsToMany(Asignatura::class, 'docenteAsignaturas', 'docenteId', 'asignaturaId')
                    ->withPivot('fechaAsignacion', 'activo')
                    ->withTimestamps();
    }

    public function proyectoAsignaturas()
    {
        return $this->hasMany(ProyectoAsignatura::class, 'docenteId');
    }

    // Accessor para nombre completo
    public function getNombreCompletoAttribute()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }
}