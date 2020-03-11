<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMemo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id', 'event_id', 'message',
    ];

    /**
     * Gets the event an event memo belongs to.
     *
     * @return  [type]  [return description]
     */
    public function event()
    {
      return $this->belongsTo('App\Models\Event');
    }

    /**
     * Gets the author of an event memo.
     *
     * @return  [type]  [return description]
     */
    public function author()
    {
      return $this->belongsTo('App\User');
    }
}
