<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'username',
        'email',
        'password',
        'activo'
    ];

    protected $hidden = [
        'password',
        'remember_token', // Cambiar de 'rememberToken' a 'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', // Cambiar de 'emailVerifiedAt'
        'activo' => 'boolean'
    ];

    // Relaciones
    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'usuarioRoles', 'usuarioId', 'rolId')
                    ->withPivot('fechaAsignacion')
                    ->withTimestamps();
    }

    // Métodos de autorización
    public function hasRole($roleName)
    {
        return $this->roles()->where('nombre', $roleName)->exists();
    }

    public function hasPermission($permisoName)
    {
        return $this->roles()->whereHas('permisos', function($query) use ($permisoName) {
            $query->where('nombre', $permisoName);
        })->exists();
    }
}