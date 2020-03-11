<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    /**
     * Gets the user who created a payment method.
     *
     * @return  \App\User
     */
    public function creator()
    {
        return $this->belongsTo('App\User');
    }
}
