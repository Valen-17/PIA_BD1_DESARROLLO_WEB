<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioRol extends Model
{
    protected $table = 'usuarioRoles';

    protected $fillable = [
        'usuarioId',
        'rolId',
        'fechaAsignacion'
    ];

    protected $dates = [
        'fechaAsignacion'
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuarioId');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rolId');
    }

    // Scopes
    public function scopeActivos($query)
    {
        return $query->whereHas('usuario', function($q) {
            $q->where('activo', true);
        });
    }
}