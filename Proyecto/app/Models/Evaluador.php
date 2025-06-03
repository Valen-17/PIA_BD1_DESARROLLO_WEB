<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluador extends Model
{
    use HasFactory;

    protected $table = 'evaluadores';

    protected $fillable = [
        'identificacion',
        'nombres',
        'apellidos',
        'email',
        'telefono',
        'especialidad',
        'usuario_id'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'evaluadorId');
    }

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'evaluador_proyecto', 'evaluador_id', 'proyecto_id');
    }

    public function getNombreCompletoAttribute()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }
}