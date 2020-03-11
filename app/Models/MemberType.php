<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberType extends Model
{
    /**
     * Gets the user who created a member type.
     *
     * @return  \App\User;
     */
    public function creator()
    {
        return $this->belongsTo('App\User');
    }
}
