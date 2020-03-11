<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    /**
     * The attributes that should be mutaded to dates
     *
     *  @var array
     */
    protected $dates = ['created_at', 'updated_at', 'start', 'end'];

    /**
     * Gets the user who created an event.
     *
     * @return App\User Returns an instance of the App\User model
     */
    public function creator()
    {
        return $this->belongsTo('App\User');
    }
}
