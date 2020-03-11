<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleMemo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var [type]
     */
    protected $fillable = [
      'author_id', 'sale_id', 'message',
  ];

    /**
     * Gets the sale of a sale memo.
     *
     * @return  [type]  [return description]
     */
    public function sale()
    {
        return $this->belongsTo('App\Models\Sale');
    }

    /**
     * Gets the user who created this sale memo.
     *
     * @return  [type]  [return description]
     */
    public function author()
    {
        return $this->belongsTo('App\User');
    }
}
