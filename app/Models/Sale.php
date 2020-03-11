<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  public $fillable = ['ticket_id', 'product_id'];

  /**
   * Gets all products in a sale.
   * 
   * @return \App\Product An instance of the Product model.
   */
  public function products()
  {
    return $this->belongsToMany('App\Models\Product', 
      'sale_product', 'sale_id', 'product_id');
  }

  /**
   * Gets all school grades of the people visiting through a sale.
   *
   * @return  array
   */
  public function grades()
  {
    return $this->belongsToMany('App\Models\Grade', 'sale_grade', 'sale_id', 'grade_id');
  }

  /**
   * Gets all the tickets in a sale.
   *
   * @return  array
   */
  public function tickets()
  {
    return $this->hasMany('App\Models\Ticket');
  }

  /**
   * Gets the user who created a sale.
   *
   * @return  \App\User
   */
  public function creator()
  {
    return $this->belongsTo('App\User');
  }

  /**
   * Gets all the payments in a sale.
   *
   * @return  array
   */
  public function payments()
  {
    return $this->hasMany('App\Models\Payment');
  }

  /**
   * Gets the customer attached to a sale.
   *
   * @return  \App\User;
   */
  public function customer()
  {
    return $this->belongsTo('App\User');
  }

  /**
   * Gets the organization attached to a sale.
   *
   * @return  \App\Organization;
   */
  public function organization()
  {
    return $this->belongsTo('App\Models\Organization');
  }

  /**
   * Gets the events in a sale.
   *
   * @return  array
   */
  public function events()
  {
    return $this->belongsToMany('App\Models\Event', 'sale_event', 'sale_id', 'event_id');
  }

  /**
   * Gets the memos in a sale.
   *
   * @return  array
   */
  public function memos()
  {
    return $this->hasMany('App\Models\SaleMemo');
  }

  /**
   * Gets the refund flag in a sale.
   *
   * @param   [type]  $value  [$value description]
   *
   * @return  [type]          [return description]
   */
  public function setRefundAttribute($value)
  {
    $this->attributes['refund'] = (bool) $value;
  }

  /**
   * Gets the balance of a sale.
   *
   * @param   [type]  $value  [$value description]
   *
   * @return  [type]          [return description]
   */
  public function getBalanceAttribute($value)
  {
    $total = (double) $this->total;
    $paid  = (double) $this->payments->sum('total');

    return $total - $paid;
  }
}
