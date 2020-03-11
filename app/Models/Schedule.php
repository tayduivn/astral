<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  /**
   * Gets the user who created a schedule.
   *
   * @return  \App\User
   */
  public function creator()
  {
    return $this->belongsTo('App\User');
  }

  /**
   * Gets all the shifts of a schedule
   *
   * @return  \App\Models\Shift
   */
  public function shifts()
  {
    return $this->belongsToMany('App\Models\Shift', 'schedule_shift', 'schedule_id', 'shift_id');
  }
}
