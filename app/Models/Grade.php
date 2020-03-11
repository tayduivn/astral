<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /**
     * Gets the user who created this grade.
     * 
     * @return App\User An instance of the User model.
     */
    public function creator()
    {
      return $this->belongsTo('App\User');
    }
}
