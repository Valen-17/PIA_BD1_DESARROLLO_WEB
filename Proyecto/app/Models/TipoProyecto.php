<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProyecto extends Model
{
    use HasFactory;

    protected $table = 'tiposProyecto';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    // Relaciones
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'tipoProyectoId');
    }
}