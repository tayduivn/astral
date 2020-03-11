<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationType extends Model
{
    /**
     * Gets the user who created an organization type.
     *
     * @return  \App\User
     */
    public function creator()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Gets all the organizations that belong to an organization type.
     *
     * @return  \App\Models\Organization
     */
    public function organizations()
    {
        return $this->hasMany('App\Models\Organization', 'type_id');
    }
}
