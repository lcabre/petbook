<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nombre
 * @property string $updated_at
 * @property string $created_at
 * @property Post[] $posts
 */
class Foto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'foto';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_foto'. 'id_foto', 'id_post')->withTimestamps();
    }

    /**
     * @return string
     */
    public function getUrl(){
        return("/storage/".$this->nombre);
    }
}
