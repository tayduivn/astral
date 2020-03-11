<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowType extends Model
{
  /**
   * The attributes that should be mutaded to dates
   *
   *  @var array
   */
  protected $dates = ['created_at', 'updated_at'];

  /**
   * Gets the user who created a show type.
   * 
   * @return App\User 
   */
  public function creator()
  {
    return $this->belongsTo('App\User');
  }
}
