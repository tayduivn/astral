<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    /**
     * Gets the author of a reply
     *
     * @return  \App\User
     */
    public function author()
    {
      return $this->belongsTo('App\User');
    }

}
