<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
  /**
   * Gets the type of an organization
   *
   * @return  \App\Models\OrganizationType
   */
  public function type()
  {
    return $this->belongsTo('App\Models\OrganizationType');
  }

  /**
   * Gets all the users who belong to an organization
   *
   * @return  array
   */
  public function users()
  {
    return $this->hasMany('App\User');
  }

  /**
   * Gets the user who created an organization.
   *
   * @return  [type]  [return description]
   */
  public function creator()
  {
    return $this->belongsTo('App\User');
  }

  /**
   * Gets all the sales made for an organization.
   *
   * @return  array
   */
  public function sales()
  {
    return $this->hasMany('App\Models\Sale');
  }

  /**
   * Gets all the events made for an organization.
   *
   * @return  array
   */
  public function events()
  {
    return $this->belongsToMany('App\Models\Event', 'organization_event', 'organization_id', 'event_id');
  }

  /**
   * Gets all the event tickets made for this organization.
   * 
   * @return \App\Models\Ticket.
   */
  public function tickets()
  {
    return $this->hasMany('App\Models\Ticket');
  }
}
