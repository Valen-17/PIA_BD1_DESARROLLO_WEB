<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'activo' => 'boolean'
    ];

    public function evaluador()
    {
        return $this->hasOne(Evaluador::class, 'usuario_id');
    }

    // ❌ Elimina estos si no vas a usar roles todavía:
    // public function roles() { ... }
    // public function hasRole() { ... }
    // public function hasPermission() { ... }
}
