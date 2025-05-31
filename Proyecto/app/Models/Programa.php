<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $table = 'programas';

    protected $fillable = [
        'descripcion',
        'departamentoId'
    ];

    // Relaciones
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamentoId');
    }

    public function asignaturas()
    {
        return $this->hasMany(Asignatura::class, 'programaId');
    }

    public function docentes()
    {
        return $this->hasMany(Docente::class, 'programaId');
    }

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'programaId');
    }
}