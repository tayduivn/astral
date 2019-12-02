<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Show extends Model
{
  /**
   * The attributes that should be mutaded to dates
   *
   *  @var array
   */
  protected $dates = ['created_at', 'updated_at', 'expiration'];

  /**
   * Returns an object with information on the user who created this Show.
   * @return App\User Returns an object with information on the user who created this Show.
   */
  public function creator()
  {
    return $this->belongsTo('App\User');
  }

  // NEED TO DELETE CURRENT SHOW TYPE PROPERTY AND HAVE THIS ONE TAKE OVER INSTEAD
  public function category()
  {
    return $this->belongsTo('App\ShowType', 'type_id');
  }

  /**
   * Fixes the URL of the show cover
   * 
   * @param String $value
   * @return String
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
      return storage_path($value);


    $value = (substr($value, 0, 4) == "http") || ($value == "/default.png")
      ? $value
      : asset("storage/$value");
    return $value;
  }

  public function getExpiredAttribute($value)
  {
    if ($this->expiration == null)
      return false;
    else
      return $this->expiration->isPast();
  }
}
