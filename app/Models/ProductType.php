<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    /**
     * Gets the user who created a product type
     * 
     * @return App\User An instance of the User model.
     */
    public function creator()
    {
      return $this->belongsTo('App\User');
    }

    /**
     * Gets all the products that have a product type
     *
     * @return  \App\Models\Product
     */
    public function products()
    {
      return $this->hasMany('App\Models\Product', 'type_id');
    }
}
