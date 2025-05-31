<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Facultad
 * 
 * @property int $id
 * @property string $descripcion
 * @property int $institucionId
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property Institucion $institucion
 * @property Collection|Departamento[] $departamentos
 *
 * @package App\Models
 */
class Facultad extends Model
{
    use HasFactory;

    protected $table = 'facultades';

    protected $fillable = [
        'descripcion',
        'institucionId'
    ];

    // Relaciones
    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'institucionId');
    }

    public function departamentos()
    {
        return $this->hasMany(Departamento::class, 'facultadId');
    }

    public function getRouteKeyName()
    {
        return 'id'; 
    }
}
