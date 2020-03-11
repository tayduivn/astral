<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\ProductType;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
      'stock' => 'integer',
      'price' => 'double',
    ];

    /**
     * Gets the user who created a product.
     *
     * @return App\User
     */
    public function creator()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Gets the type of a product
     *
     * @return App\Models\ProductType
     */
    public function type()
    {
        return $this->belongsTo('App\Models\ProductType');
    }

    /**
     * Gets the sales that sold this product.
     *
     * @return  array
     */
    public function sales()
    {
        return $this->belongsToMany('App\Models\Sale', 'sale_product', 'product_id', 'sale_id');
    }

    /**
     * Gets the URL of the product cover.
     *
     * @param string $value
     * @return string
     */
    public function getCoverAttribute($value)
    {
        $value = substr($value, 0, 4) == "/def"
                                      ? asset("$value")
                                      : asset("/storage/$value");
        return $value;
    }
}
