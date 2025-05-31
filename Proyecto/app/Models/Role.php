<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    // Relaciones
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuarioRoles', 'rolId', 'usuarioId')
                    ->withPivot('fechaAsignacion')
                    ->withTimestamps();
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'rolPermisos', 'rolId', 'permisoId')
                    ->withTimestamps();
    }
}