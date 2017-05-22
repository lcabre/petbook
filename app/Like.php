<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_post
 * @property string $updated_at
 * @property string $created_at
 * @property Post $post
 */
class Like extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id_post', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Post', 'id_post');
    }
}
