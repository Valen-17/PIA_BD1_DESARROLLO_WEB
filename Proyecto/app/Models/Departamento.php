<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';

    protected $fillable = [
        'descripcion',
        'facultadId'
    ];

    // Relaciones
    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'facultadId');
    }

    public function programas()
    {
        return $this->hasMany(Programa::class, 'departamentoId');
    }
}