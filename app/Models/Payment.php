<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var [type]
   */
  protected $fillable = ['cashier_id', 'payment_method_id', 'tendered', 
  'total', 'change_due', 'source', 'sale_id'];


  /**
   * Gets the payment method of a payment.
   *
   * @return  \App\Models\PaymentMethod
   */
  public function method()
  {
    return $this->hasOne('App\Models\PaymentMethod', 'id', 'payment_method_id');
  }

  /**
   * Gets the user who created this payment
   *
   * @return  \App\User
   */
  public function cashier()
  {
    return $this->belongsTo('App\User');
  }

  /**
   * Gets the sale that this payment belongs to.
   *
   * @return  \App\Models\Sale
   */
  public function sale()
  {
    return $this->belongsTo('App\Models\Sale');
  }
}
