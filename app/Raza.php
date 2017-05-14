<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_tipo_mascota
 * @property string $nombre
 * @property string $updated_at
 * @property string $created_at
 * @property TipoMascota $tipoMascota
 * @property AptoCita[] $aptoCitas
 * @property Mascota[] $mascotas
 */
class Raza extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'raza';

    /**
     * @var array
     */
    protected $fillable = ['id_tipo_mascota', 'nombre'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoMascota()
    {
        return $this->belongsTo('App\TipoMascota', 'id_tipo_mascota');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aptoCitas()
    {
        return $this->hasMany('App\AptoCita', 'id_raza');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mascotas()
    {
        return $this->hasMany('App\Mascota', 'id_raza');
    }
}
