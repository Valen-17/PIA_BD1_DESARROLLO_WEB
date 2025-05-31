<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolPermiso extends Model
{
    protected $table = 'rolPermisos';

    protected $fillable = [
        'rolId',
        'permisoId'
    ];

    // Relaciones
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rolId');
    }

    public function permiso()
    {
        return $this->belongsTo(Permiso::class, 'permisoId');
    }

    // Método helper para verificar si un rol tiene un permiso específico
    public static function rolTienePermiso($rolId, $permisoNombre)
    {
        return self::whereHas('rol', function($query) use ($rolId) {
                $query->where('id', $rolId);
            })
            ->whereHas('permiso', function($query) use ($permisoNombre) {
                $query->where('nombre', $permisoNombre);
            })
            ->exists();
    }
}