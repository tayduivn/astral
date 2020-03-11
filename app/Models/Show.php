<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Show extends Model
{
  /**
   * The attributes that should be mutaded to dates.
   *
   *  @var array
   */
  protected $dates = ['created_at', 'updated_at', 'expiration'];

  /**
   * Gets the user who created an event.
   * 
   * @return \App\User
   */
  public function creator()
  {
    return $this->belongsTo('App\User');
  }

  // NEED TO DELETE CURRENT SHOW TYPE PROPERTY AND HAVE THIS ONE TAKE OVER INSTEAD
  public function category()
  {
    return $this->belongsTo('App\Models\ShowType', 'type_id');
  }

  /**
   * Gets the URL of the show cover.
   * 
   * @param string $value
   * @return string
   */
  public function getCoverAttribute($value)
  {

    // Covers that come from links
    if (substr($value, 0, 4) == "http")
      return $value;
    // Default covers
    else if ($value === '/default.png')
      return asset($value);
    // Uploaded covers
    else
      return asset("storage/$value");
  }

  /**
   * Gets expired flag of a show.
   *
   * @param string $value
   * @return boolean
   */
  public function getExpiredAttribute($value)
  {
    if ($this->expiration == null)
      return false;
    else
      return $this->expiration->isPast();
  }
}
