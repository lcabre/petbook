<?php

namespace App;

use App\Traits\DatesTranslator;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_mascota
 * @property integer $id_usuario
 * @property string $titulo
 * @property string $descripcion
 * @property string $updated_at
 * @property string $created_at
 * @property Like[] $likes
 * @property Foto[] $fotos
 * @property Video[] $videos
 * @property Mascota[] $mascota
 * @property Visita[] $visitas
 */
class Post extends Model
{
    use DatesTranslator;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post';

    /**
     * @var array
     */
    protected $fillable = ['id_mascota', 'titulo', 'descripcion', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany('App\Like', 'id_post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fotos()
    {
        return $this->belongsToMany('App\Foto', 'post_foto', 'id_post', 'id_foto')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function videos()
    {
        return $this->belongsToMany('App\Video', 'post_video', 'id_post', 'id_video')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visitas()
    {
        return $this->hasMany('App\Visita', 'id_post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mascota()
    {
        return $this->belongsTo('App\Mascota', 'id_mascota');
    }

    /**
     * @return bool|Foto
     */
    public function getFoto(){
        if($foto = $this->fotos()->first())
            return($foto);
        return false;
    }

    /**
     * @return Mascota
     */
    public function getMascota(){
        return $this->mascota()->first();
    }
}
