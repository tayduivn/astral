<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{

  /**
   * The attribules that should be mutated to dates.
   *
   * @var Illuminate\Support\Carbon
   */
    protected $dates = ['created_at', 'updated_at', 'start', 'end'];

    /**
     * The attributes that are mass assignable.
     *
     * @var [type]
     */
    protected $fillable = ["shift_id", "user_id"];

    /**
     * Gets all the users in a shift.
     *
     * @return  array
     */
    public function employees()
    {
        return $this->belongsToMany('App\User', 'shift_user', 'shift_id', 'user_id');
    }

    /**
     * Gets all the positions in a shift.
     *
     * @return  array
     */
    public function positions()
    {
        return $this->belongsToMany('App\Models\Position', 'shift_position', 'shift_id', 'position_id');
    }

    /**
     * Gets the user who created a shift.
     *
     * @return  array
     */
    public function creator()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Gets all the events that will be covered by a shift.
     *
     * @return  array
     */
    public function events()
    {
        return $this->belongsToMany('App\Models\Event', 'shift_event', 'shift_id', 'event_id');
    }

    /**
     * Gets all the schedules this shift belongs to.
     *
     * @return  array
     */
    public function schedules()
    {
        return $this->belongsToMany('App\Models\Schedule', 'schedule_shift', 'shift_id', 'schedule_id');
    }
}
