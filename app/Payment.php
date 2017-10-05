<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  public function method()
  {
    return $this->hasOne('App\PaymentMethod', 'id', 'payment_method_id');
  }

  public function cashier()
  {
    return $this->belongsTo('App\User');
  }
}