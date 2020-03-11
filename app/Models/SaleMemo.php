<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleMemo extends Model
{

  protected $fillable = [
      'author_id', 'sale_id', 'message',
  ];

    //
    public function sale()
    {
      return $this->belongsTo('App\Models\Sale');
    }

    public function author()
    {
      return $this->belongsTo('App\User');
    }
}
