<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    /**
     * [$casts description]
     *
     * @var [type]
     */
    protected $casts = [
      'public' => 'boolean',
      'price'  => 'double',
    ];
    
    /**
     * Returns allowed event types for this ticket type
     *
     * @return array
     */
    public function allowedEvents()
    {
      return $this->belongsToMany('App\Models\EventType', 
        'allowed_ticket_events', 
        'ticket_type_id', 
        'event_type_id');
    }

    /**
     * Returns creator of this ticket type
     *
     * @return  \App\User  Returns the user who created this record
     */
    public function creator()
    {
      return $this->belongsTo('App\User');
    }
}
