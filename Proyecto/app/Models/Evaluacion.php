<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';

    protected $fillable = [
        'proyectoId',
        'evaluadorId',
        'contenido',
        'problematizacion',
        'objetivos',
        'metodologia',
        'resultados',
        'potencial',
        'interaccionPublico', 
        'creatividad',
        'innovacion',
        'concluciones'  
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];



    // Relaciones
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyectoId');
    }

    public function evaluador()
    {
        return $this->belongsTo(Evaluador::class, 'evaluadorId');
    }

}