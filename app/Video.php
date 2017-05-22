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
class Video extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'video';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_video', 'id_video', 'id_post')->withTimestamps();
    }
}
