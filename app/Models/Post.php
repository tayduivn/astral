<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Gets the author of a post.
     *
     * @return  [type]  [return description]
     */
    public function author()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Gets the category of a post.
     *
     * @return  \App\Models\Category;
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Reply');
    }
}
