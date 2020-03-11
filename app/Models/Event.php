<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['start', 'end', 'memo', 'seats', 'creator_id',
    'type_id', 'public', 'show_id'];
  
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['title'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var Illuminate\Support\Carbon;
     */
    protected $dates = ['created_at', 'updated_at', 'start', 'end'];

    /**
     * The main show attached to an event.
     *
     * @return  \App\Show
     */
    public function show()
    {
        return $this->belongsTo('App\Models\Show');
    }

    /**
     * Gets the user who created an event.
     *
     * @return  \App\User;
     */
    public function creator()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Gets all the sales attached to an event.
     *
     * @return  array
     */
    public function sales()
    {
        return $this->belongsToMany('App\Models\Sale', 'sale_event', 'event_id', 'sale_id');
    }

    /**
     * Gets the type of an event.
     *
     * @return  \App\Models\EventType;
     */
    public function type()
    {
        return $this->belongsTo('App\Models\EventType');
    }

    /**
     * Gets all the event memos left for an event.
     *
     * @return  \App\Models\EventMemo;
     */
    public function memos()
    {
        return $this->hasMany('App\Models\EventMemo');
    }

    /**
     * Gets all the tickets for an event.
     *
     * @return  \App\Models\Ticket;
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    /**
     * Gets all the shifts attached to an event.
     *
     * @return  array
     */
    public function shifts()
    {
        return $this->belongsToMany(
        'App\Models\Shift',
        'shift_event',
        'event_id',
        'shift_id'
    );
    }

    /**
     * Gets the custom title of an event.
     *
     * @return  string
     */
    public function getTitleAttribute()
    {
        return $this->attributes['memo'];
    }
}
