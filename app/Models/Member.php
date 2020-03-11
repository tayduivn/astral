<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
  /**
   * The accesors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = ['number', 'expired'];
  /**
   * The attributes that should be mutaded to dates
   * 
   * @var array
   */
  protected $dates = ['created_at', 'updated_at', 'start', 'end'];

  /**
   * Defining mass assignment properties of this model
   * @var array
   */
  protected $fillable = ['member_type_id', 'start', 'end', 'primary_id', 'creator_id'];

  /**
   * Gets the type of this membership.
   *
   * @return \App\Models\MembershipType
   */
  public function type()
  {
    return $this->belongsTo('App\Models\MemberType', 'member_type_id');
  }

  /**
   * Gets the user who created a membership.
   *
   * @return \App\User Returns all App\User objects under this membership with the first always being the primary.
   */
  public function secondaries()
  {
    return $this->hasMany('App\User', 'membership_id')->where('id', '!=', $this->primary_id);
  }

  /**
   * Gets the primary user of a membership.
   * 
   * @return App\User Returns the primary on the current membership
   */
  public function primary()
  {
    return $this->belongsTo('App\User');
  }

  /**
   * Gets the all the users attached to a membership.
   *
   * @return  [type]  [return description]
   */
  public function getUsersAttribute()
  {
    $primary = $this->primary;
    $secondaries = $this->secondaries->all();

    return array_prepend($secondaries, $primary);
  }

  /**
   * Gets the user who created a membership.
   *
   * @return \App\User Returns creator of the membership
   */
  public function creator()
  {
    return $this->belongsTo('App\User');
  }

  /**
   * Gets the membership number formatted to the length defined in settings
   *
   * @return string
   */
  public function getNumberAttribute()
  {
    $length = (int) \App\Models\Setting::find(1)->membership_number_length;
    return str_pad($this->attributes['id'], $length, '0', STR_PAD_LEFT);
  }

  /**
   * Gets the expired flag of a membership.
   *
   * @return  boolean
   */
  public function getExpiredAttribute()
  {
    return $this->end->isPast();
  }
}
