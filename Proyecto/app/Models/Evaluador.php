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
        'especialidad'
    ];

    // Relaciones
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'evaluadorId');
    }

    // Accessor para nombre completo
    public function getNombreCompletoAttribute()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }
}
