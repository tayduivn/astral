<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * Gets the user who created a position.
     *
     * @return  \App\User
     */
    public function creator()
    {
      return $this->belongsTo('App\User');
    }
}
