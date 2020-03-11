<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Gets the user who created a category.
     *
     * @return  \App\User
     */
    public function creator()
    {
        return $this->belongsTo('App\User');
    }
}
