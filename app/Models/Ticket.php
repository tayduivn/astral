<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var [type]
     */
    protected $fillable = [
      'ticket_type_id', 'event_id', 'customer_id', 'cashier_id', 'organization_id'
    ];

    /**
     * Gets the sale related to a ticket.
     *
     * @return  [type]  [return description]
     */
    public function sale()
    {
        return $this->belongsTo('App\Models\Sale');
    }

    /**
     * Gets the event related to a ticket.
     *
     * @return  [type]  [return description]
     */
    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    /**
     * Gets the type of a ticket.
     *
     * @return  [type]  [return description]
     */
    public function type()
    {
        return $this->hasOne('App\Models\TicketType', 'id', 'ticket_type_id');
    }
}
