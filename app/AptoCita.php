<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_mascota
 * @property integer $id_usuario
 * @property integer $id_raza
 * @property integer $tamanio
 * @property integer $radio_km
 * @property string $updated_at
 * @property string $created_at
 * @property Raza $raza
 */
class AptoCita extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'apto_cita';

    /**
     * @var array
     */
    protected $fillable = ['id_mascota', 'id_raza', 'tamanio', 'radio_km'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function raza()
    {
        return $this->belongsTo('App\Raza', 'id_raza');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mascota()
    {
        return $this->belongsTo('App\Mascota', 'id_mascota');
    }
}
