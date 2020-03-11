<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Gets the user who created a role.
     *
     * @return  \App\User
     */
    public function creator()
    {
      return $this->belongsTo('App\User');
    }

    /**
     * Gets the permissions of a role.
     *
     * @return  \App\RoleAccessControl
     */
    public function permissions()
    {
      return $this->hasOne('App\Models\RoleAccessControl');
    }
}
