<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nombre
 * @property string $updated_at
 * @property string $created_at
 * @property Raza[] $razas
 */
class TipoMascota extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tipo_mascota';

    /**
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function razas()
    {
        return $this->hasMany('App\Raza', 'id_tipo_mascota');
    }
}
