<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Institucion
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $direccion
 * @property string|null $telefono
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @property Collection|Facultad[] $facultades
 *
 * @package App\Models
 */
class Institucion extends Model
{
    use HasFactory;

    protected $table = 'instituciones';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono'
    ];

    // Relaciones
    public function facultades()
    {
        return $this->hasMany(Facultad::class, 'institucionId');
    }
}
