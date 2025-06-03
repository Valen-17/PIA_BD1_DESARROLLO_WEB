<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'titulo',
        'descripcion',
        'fechaInicio',
        'fechaFin',
        'tipoProyectoId'
    ];

    protected $casts = [
        'fechaInicio' => 'datetime',
        'fechaFin' => 'datetime',
    ];

    public function estadoFormateado()
    {
        switch ($this->estado) {
            case 0:
                return 'Pendiente';
            case 1:
                return 'Aprobado';
            case 2:
                return 'Rechazado';
            default:
                return 'Desconocido';
        }
    }

    // Relaciones
    public function tipoProyecto()
    {
        return $this->belongsTo(TipoProyecto::class, 'tipoProyectoId');
    }

    public function asignaturas()
    {
        return $this->belongsToMany(Asignatura::class, 'proyectoAsignaturas', 'proyectoId', 'asignaturaId')
                    ->withPivot('docenteId', 'grupo', 'semestre', 'año')
                    ->withTimestamps();
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'proyectoId');
    }

    public function evaluadores()
    {
        return $this->belongsToMany(Evaluador::class, 'evaluador_proyecto', 'proyecto_id', 'evaluador_id');
    }

    public function proyectoAsignaturas()
    {
        return $this->hasMany(ProyectoAsignatura::class, 'proyectoId');
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->where('fechaFin', '>=', now())->orWhereNull('fechaFin');
    }

    public function promedioEvaluacion()
    {
        if ($this->evaluaciones->count() === 0) {
            return null;
        }

        // Lista de campos evaluables
        $criterios = [
            'contenido',
            'problematizacion',
            'objetivos',
            'metodologia',
            'resultados',
            'potencial',
            'interaccionPublico',
            'creatividad',
            'innovacion'
        ];

        $totalPuntajes = 0;
        $totalItems = 0;

        foreach ($this->evaluaciones as $evaluacion) {
            foreach ($criterios as $criterio) {
                if (!is_null($evaluacion->$criterio)) {
                    $totalPuntajes += $evaluacion->$criterio;
                    $totalItems++;
                }
            }
        }

        return $totalItems > 0 ? round($totalPuntajes / $totalItems, 2) : null;
    }
}
