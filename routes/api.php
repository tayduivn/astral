<?php

use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;

use App\{ Event, Setting, User, PaymentMethod, Sale, Organization, EventType };
use App\{ MemberType, Show, TicketType };
use Illuminate\Support\Facades\{ Auth, Storage };
use Illuminate\Support\Carbon;
use App\Product;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::get('events', function() {
  // Get today's date for the query that will show today's events
  $today = Date::now('America/Chicago')->addMinutes(-30)->toDateTimeString();
  $events = Event::where('start','>=', $today)
              ->where('start','<=', Date::now('America/Chicago')->endOfDay())
              ->orderBy('start', 'desc')
              ->get();
  $eventsArray = [];
  foreach ($events as $event) {
    $eventsArray = array_prepend($eventsArray, [
      'id'       => $event->id,
      'type'     => $event->type->name,
      'start'    => $event->start,
      'end'      => $event->end,
      'seats'    => $event->seats - App\Ticket::where('event_id', $event->id)->count(),
      'show'     => [
        'name'  => $event->show->name,
        'type'  => $event->show->category->name,
        'cover' => $event->show->cover
        ],
      'allowedTickets' => $event->type->allowedTickets,
    ]);
  }
  return $eventsArray;
});*/

Route::get('shows', function(Request $request) {
  $shows = Show::where('id', '!=', 1)->orderBy('name', 'asc')->get();
  return $shows;

});

Route::get('shows/{id}', function($id) {
  $show = Show::find($id);
  return $show;
});

// This API is consumed by /admin/calendar/sales in Full Calendar
Route::get('calendar/sales', function(Request $request) {
  $start = Date::parse($request->start)->startOfDay()->toDateTimeString();
  $end = Date::parse($request->end)->endOfDay()->toDateTimeString();
  $sales = Sale::where([
                        ['customer_id',     '!=', 1],
                        //['organization_id', '!=', 1],
                        ['refund', false],
                      ])->get();
  $eventsArray = [];
  foreach ($sales as $sale) {
    $events = $sale->events->where('start', '>=', $start)->where('end', '<', $end)->where('type_id', '!=', 1);
    $customer = ($sale->customer->firstname == $sale->organization->name) ? null : ' - ' . $sale->customer->fullname;
    $organization = ($sale->organization->id == 1)? null : ' - ' . $sale->organization->name;
    $organization = $sale->sell_to_organization ? $organization : null;
    foreach ($events->unique('id') as $event) {
      $seats = $event->seats - App\Ticket::where('event_id', $event->id)->count();
      $startTime = Date::parse($event->start)->format('i') == "00" ? Date::parse($event->start)->format('g') : Date::parse($event->start)->format('g:i');
      $startTime = Date::parse($event->start)->format('a') == 'am' ? $startTime . 'a' : $startTime . 'p';
      $endTime = Date::parse($event->end)->format('i') == "00" ? Date::parse($event->end)->format('g') : Date::parse($event->end)->format('g:i');
      $endTime = Date::parse($event->end)->format('a') == 'am' ? $endTime . 'a' : $endTime . 'p';
      $title = "$startTime-$endTime | Sale #$sale->id ($sale->status) \n" . $event->show->name .  $organization . $customer;
      $eventsArray = array_prepend($eventsArray, [
        'id'       => $sale->id,
        'type'     => $event->type->name,
        'start'    => Date::parse($event->start)->toDateTimeString(),
        'end'      => Date::parse($event->end)->toDateTimeString(),
        'seats'    => $event->seats - App\Ticket::where('event_id', $event->id)->count(),
        'title'    => $title,
        //'url'      => route('admin.events.show', $event),
        'show'     => [
          'name'  => $event->show->name,
          'type'  => $event->show->category->name,
          'cover' => substr($event->show->cover, 0, 4) == 'http' ? $event->show->cover : Storage::url($event->show->cover),
        ],
        'color' => $sale->status == 'canceled' ? 'red' : $event->type->color,
        'backgroundColor' => $sale->status == 'canceled' ? 'red' : $event->type->color,
        'textColor' => 'rgba(255, 255, 255, 0.8)',
      ]);
    }
  }
  return $eventsArray;
});

Route::get('sales', function() {
  $allSales = Sale::all();

  $sales = [];

  foreach ($allSales as $sale) {
    $sales = array_prepend($sales, [
      'id'                 => $sale->id,
      'creator'            => $sale->creator->firstname,
      'status'             => $sale->status,
      'source'             => $sale->source,
      'taxable'            => boolval($sale->taxable),
      'subtotal'           => $sale->subtotal,
      'tax'                => $sale->tax,
      'total'              => $sale->total,
      'balance'            => number_format($sale->total - $sale->payments->sum('tendered'), 2),
      'refund'             => $sale->refund,
      'customer'           => $sale->customer->fullname,
      'organization'       => $sale->organization->name,
      'sellToOrganization' => boolval($sale->sell_to_organization),
      'payments'           => $sale->payments
    ]);
  };

  return $sales;
});

Route::get('calendar-events', function() {
  $today = Date::parse()->format('Y-m-d');
  $todaysEvents = Event::whereDate('start', '>=', $today)->get();
  $todaysEventsIds = [];
  $salesIds = [];

  foreach ($todaysEvents as $todaysEvent) {
    foreach ($todaysEvent->sales as $todaysEventSale) {
      array_push($salesIds, $todaysEventSale->id);
    }
  }

  $salesIds = array_unique($salesIds);

  $salesArray = [];
  $eventsArray = [];
  $ticketsArray = [];

  // Get all sales not assigned to walkups
  $sales = Sale::where('customer_id', '!=', 1)->whereIn('id', $salesIds)->get();

  foreach ($sales as $sale) {
    // Get id of today's events based on today's sales
    $eventIds = array_pluck($sale->events, 'id');
    // Get all events that are not "no events"
    $events = Event::where('id', '!=', 1)->whereIn('id', $eventIds)->get();
    foreach ($events as $event) {
      $eventsArray = array_prepend($eventsArray, [
        'id'      => $event->id,
        'start'   => $event->start,
        'end'     => $event->end,
        'seats'   => $event->seats,
        'type'    => $event->type->name,
        'creator' => $event->creator->fullname,
        'show' => [
          'id'       => $event->show->id,
          'name'     => $event->show->name,
          'type'     => $event->show->category->name,
          'duration' => $event->show->duration,
          'cover'    => substr($event->show->cover, 0, 4) == 'http' ? $event->show->cover : Storage::url($event->show->cover),
        ],
      ]);
    }

    // Loop through tickets for this sale, get type and quantity for each type
    $tickets = $sale->tickets->unique('ticket_type_id');
    foreach ($tickets as $ticket) {
      $q = $sale->tickets->where('ticket_type_id', $ticket->type->id)->count();
      $quantity = $sale->events[1]->show_id == 1 ? $q : $q/2;
      $ticketsArray = array_prepend($ticketsArray, [
        'type'     => $ticket->type->name,
        'price'    => $ticket->type->price,
        'quantity' => $quantity,
      ]);
    }

    $salesArray = array_prepend($salesArray, [
      'id'         => $sale->id,
      'creator'    => $sale->creator->fullname,
      'created_at' => Date::parse($sale->created_at)->toDateTimeString(),
      'start'      => $sale->events[0]->start,
      'status'     => $sale->status,
      'source'     => $sale->source,
      'total'      => $sale->total,
      'memo'       => $sale->memo,
      'customer'   => [
        'name'         => $sale->customer->fullname,
        'organization' => $sale->customer->organization->name,
        'phone'        => $sale->customer->phone,
        'email'        => $sale->customer->email,
      ],
      'events'    => $eventsArray,
      'tickets'   => $ticketsArray,
    ]);
    $eventsArray = [];
    $ticketsArray = [];
  }

  $salesCollect = collect($salesArray);

  $sorted = $salesCollect->sortBy('start');

  $sorted = $sorted->values()->all();

  return $sorted;
});

// This API is consumed by the MODAL that shows event information in /admin/calendar
Route::get('event/{event}', function(Event $event) {

  // Get all Sales for this event
  $salesArray    = [];
  $ticketsArray  = [];
  $productsArray = [];
  $ticketsSold   = 0;
  //$ticketsSold += App\Ticket::where('event_id', $event->id)->count();
  foreach ($event->sales as $sale) {
    if ($sale->status != 'canceled')
      $ticketsSold += App\Ticket::where([['event_id', $event->id], ['sale_id', $sale->id]])->count();
    if ($sale->tickets->count() > 1) {
      // Loop through tickets for this sale, get type and quantity for each type
      $tickets = $sale->tickets->where('event_id', $event->id)->unique('ticket_type_id')->all();
      foreach ($tickets as $ticket) {
        $quantity = $sale->tickets->where('ticket_type_id', $ticket->ticket_type_id)->where('event_id', $event->id)->count();
        //$quantity = $sale->events[0]->show_id == 1 ? $q : $q/2;
        $ticketsArray = array_prepend($ticketsArray, [
          'type'     => $ticket->type->name,
          'price'    => $ticket->type->price,
          'quantity' => $quantity,
        ]);
      }
    }

    // Taking out non-refunded and walkup sales
    if ($sale->customer_id != 1) {
      if (!$sale->refund) {
        foreach ($sale->products->unique('id') as $product) {
          $productsArray = array_prepend($productsArray, [
            'id'       => $product->id,
            'name'     => $product->name,
            'price'    => number_format($product->price, 2),
            'quantity' => $sale->products->where('id', $product->id)->count(),
          ]);
        }
        $salesArray = array_prepend($salesArray, [
          'id' => $sale->id,
          'customer'        => [
            'id'   => $sale->customer_id,
            // check if last name has a space in the end for organization accounts
            'name' => $sale->customer->lastname == null ? $sale->customer->firstname : $sale->customer->fullname,
          ],
          'organization'    => [
            'id'   => $sale->organization_id,
            'name' => $sale->organization->name,
          ],
          'creator' => [
            'id' => $sale->creator_id,
            'name' => $sale->creator->fullname,
          ],
          'total'                => $sale->total,
          'tickets'              => $ticketsArray,
          'products'             => $productsArray,
          'status'               => $sale->status,
          'sell_to_organization' => (bool)$sale->sell_to_organization,
          'created_at'           => Date::parse($sale->created_at)->toDateTimeString(),
          'updated_at'           => Date::parse($sale->updated_at)->toDateTimeString(),
        ]);
      }
    }

    // clear ticket array after we loop through this event
    $ticketsArray  = [];
    $productsArray = [];
  }

  $memos = [];
  $memosArray = [];
  foreach ($event->memos as $memo) {
    $memosArray = array_prepend($memosArray, [
      'id'         => $memo->id,
      'message'    => $memo->message,
      'author'     => [
        'name' => $memo->author->fullname,
        'role' => $memo->author->role->name,
      ],
      'created_at' => Date::parse($memo->created_at)->toDateTimeString(),
      'updated_at' => Date::parse($memo->updated_at)->toDateTimeString(),
    ]);
  }
  $isAllDay = (Date::parse($event->start)->isStartOfDay() && Date::parse($event->end)->isEndOfDay());
  return [
    'id'       => $event->id,
    'type'     => $event->type->name,
    'start'    => Date::parse($event->start)->toDateTimeString(),
    'end'      => Date::parse($event->end)->toDateTimeString(),
    'color'    => $event->type->color,
    'seats'    => $event->seats - App\Ticket::where('event_id', $event->id)->count(),
    //'url'      => '#' . $event->id,
    'creator' => [
      'name' => $event->creator->fullname,
      'role' => $event->creator->role->name,
    ],
    'show'     => [
      'id'          => $event->show->id,
      'name'        => $event->show->name,
      'description' => $event->show->description,
      'type'        => $event->show->category->name,
      'duration'    => $event->show->duration,
      'cover'       => substr($event->show->cover, 0, 4) == 'http' ? $event->show->cover : Storage::url($event->show->cover),
    ],
    'sales'   => $salesArray,
    'tickets_sold' => $ticketsSold,
    'memo'       => $event->memo,
    'created_at' => Date::parse($event->created_at)->toDateTimeString(),
    'updated_at' => Date::parse($event->updated_at)->toDateTimeString(),
    'memos'      => $memosArray,
    'allDay'     => $isAllDay,
  ];
});

// This API is consumed by Full Calendar in /admin/calendar/events
Route::get('/calendar/events', function(Request $request) {
  $start = Date::parse($request->start)->startOfDay()->toDateTimeString();
  $end = Date::parse($request->end)->endOfDay()->addMinute()->toDateTimeString();
  $type = isSet($request->type) ? $request->type : null;
  $events = Event::where([
                          ['start'  , '>=', $start],
                          ['end'    , '<=', $end  ],
                        ]);
  $events = isSet($request->type) ? $events->where('type_id', $request->type)->get() : $events->get();
  $eventsArray = [];
  foreach ($events as $event)
  {
    $ticketsSold = 0;
    foreach ($event->sales as $sale)
    {
      // If event is canceled, calculate attendance
      if ($sale->status != 'canceled')
      {
        // If there's only one event, show number of tickets sold...
        if ($sale->events->count() == 1)
          $ticketsSold += $sale->tickets->count();
        // ...else, divide the number of tickets in the sale by the number of events in the sale
        else
          $ticketsSold += ($sale->tickets->count() / $sale->events->count());
      }
      else
        $ticketsSold += 0;
      // $ticketsSold += $sale->status != 'canceled' ? $sale->tickets->count() : 0;
    }
    $seats = $event->seats - $ticketsSold;
    $isAllDay = (Date::parse($event->start)->isStartOfDay() && Date::parse($event->end)->isEndOfDay());
    $startTime = Date::parse($event->start)->format('i') == "00" ? Date::parse($event->start)->format('g') : Date::parse($event->start)->format('g:i');
    $startTime = Date::parse($event->start)->format('a') == 'am' ? $startTime . 'a' : $startTime . 'p';
    $endTime = Date::parse($event->end)->format('i') == "00" ? Date::parse($event->end)->format('g') : Date::parse($event->end)->format('g:i');
    $endTime = Date::parse($event->end)->format('a') == 'am' ? $endTime . 'a' : $endTime . 'p';
    $eventsArray = array_prepend($eventsArray, [
      'id'       => $event->id,
      'type'     => $event->type->name,
      'start'    => $isAllDay ? Date::parse($event->start)->format('Y-m-d') : Date::parse($event->start)->toDateTimeString(),
      'end'      => $isAllDay ? '' : Date::parse($event->end)->toDateTimeString(),
      // Take out tickets from shows that have been canceled!!!
      'seats'    => $seats, // $event->seats - App\Ticket::where('event_id', $event->id)->count(),
      'title'    => $event->show_id !=1 ? "$startTime-$endTime | Event #$event->id ($seats seats left) \n {$event->show->name}" : (isSet($event->memo) ? $event->memo : $event->type->name),
      //'url'      => '/admin/events/' . $event->id,
      'show'     => [
        'name'        => $event->show->name,
        'type'        => $event->show->category->name,
        'cover'       => substr($event->show->cover, 0, 4) == 'http' ? $event->show->cover : Storage::url($event->show->cover),
        'duration'    => $event->show->duration,
        'description' => $event->show->description,
        ],
      'allowedTickets' => $event->type->allowedTickets,
      'date'            => $start,
      'color'           => $event->type->color,
      'backgroundColor' => $event->type->color,
      'textColor'       => 'rgba(255, 255, 255, 0.8)',
      'public'          => $event->public,
      'allDay'          => $isAllDay,
    ]);
  }
  $eventsCollect = collect($eventsArray);

  $eventsCollect = $eventsCollect->sortBy('start');

  $eventsCollect = $eventsCollect->values()->all();
  return response($eventsCollect);
});

Route::get('staff', function() {
  $staff = User::where('staff', true)->orderBy('name', 'asc')->get();
  return $staff;
});

// This URL is consumed in the new Sales interface
Route::get('events', function(Request $request) {
  $start = Date::parse($request->start)->startOfDay();

  $end = $request->has('end')
          ? Date::parse($request->end)->endOfDay()
          : Date::parse($request->start)->endOfDay();

  $q = [
    ['show_id', '!=', 1],
  ];

  if ($request->has('start'))  array_push($q, ['start', '>=', $start->startOfDay()->toDateTimeString()]);
  // There's already a check in place to make the end date something if the request doesn't have an end date!
  array_push($q, ['end', '<=', $end->endOfDay()->toDateTimeString()]);
  if ($request->has('type'))   array_push($q, ['type_id', $request->type]);
  if ($request->has('public')) array_push($q, ['public', $request->public]);

  $type = isSet($request->type) ? $request->type : null;
  $events = Event::where($q)->get();
  $eventsArray = [];
  foreach ($events as $event) {
    $ticketsSold = 0;
    foreach ($event->sales as $sale) {
        $ticketsSold += $sale->status != 'canceled' ? $sale->tickets->count() : 0;
    }
    $seats = $event->seats - $ticketsSold;
    $isAllDay = (($event->start->isStartOfDay()) && ($event->end->isEndOfDay()));
    $allowedTicketsArray = [];
    foreach ($event->type->allowedTickets->where('public', true) as $allowedTicket)
    {
      $allowedTicketsArray = array_prepend($allowedTicketsArray, [
        'id' => $allowedTicket->id,
        'name' => $allowedTicket->name,
        'price' => (double)$allowedTicket->price,
      ]);
    }
    $eventsArray = array_prepend($eventsArray, [
      'id'       => $event->id,
      'type'     => $event->type->name,
      'start'    => $isAllDay ? $event->start->format('Y-m-d') : $event->start->toDateTimeString(),
      'end'      => $isAllDay ? '' : $event->end->toDateTimeString(),
      // Take out tickets from shows that have been canceled!!!
      'seats'    => $seats, // $event->seats - App\Ticket::where('event_id', $event->id)->count(),
      'title'    => $event->show_id !=1 ? "{$event->show->name}, $seats seats left" : (isSet($event->memo) ? $event->memo : $event->type->name),
      //'url'      => '/admin/events/' . $event->id,
      'show'     => [
        'name'        => $event->show->name,
        'type'        => $event->show->category->name,
        'duration'    => (int)$event->show->duration,
        'cover'       => $event->show->cover,
        'description' => $event->show->description,
        ],
      'allowedTickets'  => $allowedTicketsArray,
      'date'            => $start,
      'color'           => $event->type->color,
      'backgroundColor' => $event->type->color,
      'textColor'       => 'rgba(255, 255, 255, 0.8)',
      'public'          => $event->public,
      'allDay'          => $isAllDay,
    ]);
  }
  $eventsCollect = collect($eventsArray);
  $eventsCollect = $eventsCollect->sortBy('start');
  $eventsCollect = $eventsCollect->values()->all();
  return response($eventsCollect);
});

// This is the URL for the /events slide show
Route::get('events/{start}/{end}', function($start, $end) {
  $start = Date::parse($start)->startOfDay()->toDateTimeString();
  $end   = Date::parse($end)->endOfDay()->toDateTimeString();
  $events = Event::where('start', '>=', $start)->where('end', '<', $end)->where('public', true)->get();
  $eventsArray = [];
  foreach ($events as $event) {
    $seats = $event->seats - App\Ticket::where('event_id', $event->id)->count();
    $eventsArray = array_prepend($eventsArray, [
      'id'       => $event->id,
      'type'     => $event->type->name,
      'color'    => $event->type->color,
      'start'    => $event->start->toDateTimeString(),
      'end'      => $event->end->toDateTimeString(),
      'seats'    => $event->seats - App\Ticket::where('event_id', $event->id)->count(),
      'title'    => "{$event->show->name} - {$event->type->name} - $seats seats left",
      'url'      => '/admin/events/' . $event->id,
      'show'     => [
        'name'        => $event->show->name,
        'type'        => $event->show->category->name,
        'cover'       => substr($event->show->cover, 0, 4) == 'http'
                           ? $event->show->cover
                           : Storage::url($event->show->cover),
        'description' => $event->show->description,
        ],
      'allowedTickets' => $event->type->allowedTickets->where('in_cashier', true),
      'date' => $start,
    ]);
  }

  $eventsCollect = collect($eventsArray);

  $eventsCollect = $eventsCollect->sortBy('start');

  $eventsCollect = $eventsCollect->values()->all();

  return $eventsCollect;
});

// This API is consumed on the add members
Route::get('membership-type/{id}', function($id) {
  $membership_type = \App\MemberType::find($id);

  return [
    'id'              => $membership_type->id,
    'name'            => $membership_type->name,
    'price'           => number_format($membership_type->price, 2, '.', ','),
    'duration'        => (float)$membership_type->duration,
    'max_secondaries' => (int)$membership_type->max_secondaries,
    'secondary_price' => (float)$membership_type->secondary_price,
  ];
});

Route::get('settings', function() {
  $settings = \App\Setting::find(1);
  return response($settings);
});

Route::get('customers', function(Request $request) {
  $customerArray = [];
  $customers = User::where('type', 'individual')->where('id', '!=', $request->primary)->orderBy('firstname', 'asc')->get();
  foreach ($customers as $customer) {
    array_push($customerArray, [
      'id' => $customer->id,
      'name' => $customer->fullname,
      'role' => $customer->role->name,
      'taxable' => (boolean)$customer->organization->type->taxable,
      'organization' => [
        'id' => $customer->organization->id,
        'name' => $customer->organization->name,
        'type' => $customer->organization->type->name,
      ],
    ]);
  }

  return $customerArray;
});

Route::get('sale/{sale}', function(Sale $sale) {
  $memosArray    = [];
  $eventsArray   = [];
  $productsArray = [];
  $gradesArray   = [];
  $paymentsArray = [];

  foreach($sale->payments as $payment)
  {
    $paymentsArray = array_prepend($paymentsArray, [
      'id'       => $payment->id,
      'method'   => $payment->method->name,
      'paid'     => number_format($payment->tendered - $payment->change_due, 2),
      'tendered' => number_format($payment->tendered, 2),
      'date'     => Date::parse($payment->created_at)->toDateTimeString(),
      'cashier'  => [
        'id'   => $payment->cashier->id,
        'name' => $payment->cashier->firstname,
      ],
    ]);
  }

  foreach($sale->products->unique('id') as $product)
  {
    $productsArray = array_prepend($productsArray, [
      'id'       => $product->id,
      'type'     => $product->type->name,
      'name'     => $product->name,
      'price'    => $product->price,
      'cover'    => $product->cover,
      'quantity' => $sale->products->where('id', $product->id)->count(),
    ]);
  }

  foreach($sale->events as $event)
  {
    $ticketsArray = [];
    foreach($event->tickets->unique('ticket_type_id') as $ticket)
    {
      $ticketsArray = array_prepend($ticketsArray, [
        'name' => $ticket->type->name,
        'quantity' => $event->tickets->where('ticket_type_id', $ticket->ticket_type_id)->count(),
      ]);
    }
    $eventsArray = array_prepend($eventsArray, [
      'id'    => $event->id,
      'type'  => $event->type->name,
      'color' => $event->type->color,
      'show' => [
        'id' => $event->show->id,
        'name'  => $event->show->name,
        'cover' => substr($event->show->cover, 0, 4) == 'http' ? $event->show->cover : Storage::url($event->show->cover),
      ],
      'start' => Date::parse($event->start)->toDateTimeString(),
      'end'   => Date::parse($event->end)->toDateTimeString(),
      'tickets' => $ticketsArray,
    ]);

  }

  foreach ($sale->memos as $memo) {
    $memosArray = array_prepend($memosArray, [
      'id'         => $memo->id,
      'message'    => $memo->message,
      'author'     => [
        'name' => $memo->author->fullname,
        'role' => $memo->author->role->name,
      ],
      'created_at' => Date::parse($memo->created_at)->toDateTimeString(),
      'updated_at' => Date::parse($memo->updated_at)->toDateTimeString(),
    ]);
  }
  return [
    'id'      => $sale->id,
    'status'  => $sale->status,
    'source'  => $sale->source,
    'memos'   => $memosArray,
    'creator' => [
      'id' => $sale->creator->id,
      'name' => $sale->creator->fullname,
      'role' => $sale->creator->role->name,
    ],
    'customer' => [
      'id'           => $sale->customer->id,
      'name'         => $sale->customer->fullname,
      'role'         => [
        'id'   => $sale->customer->role->id,
        'name' => $sale->customer->role->name,
      ],
      'organization' => [
        'id' => $sale->customer->organization->id,
        'name' => $sale->customer->organization->name,
      ],
      'address'      => "{$sale->customer->address} {$sale->customer->city}, {$sale->customer->state} {$sale->customer->zip}",
      'phone'        => $sale->customer->phone,
      'email'        => $sale->customer->email,
    ],
    'organization' => [
      'id'    => $sale->organization->id,
      'name'  => $sale->organization->name,
      'type'         => $sale->organization->type->name,
      'address'      => "{$sale->organization->address} {$sale->organization->city}, {$sale->organization->state} {$sale->organization->zip}",
      'phone'        => $sale->customer->phone,
      'email'        => $sale->customer->email,
    ],
    'events'               => $eventsArray,
    'grades'               => $sale->grades,
    'products'             => $productsArray,
    'sell_to_organization' => (bool)$sale->sell_to_organization,
    'subtotal'             => number_format($sale->subtotal, 2),
    'tax'                  => number_format($sale->total - $sale->subtotal, 2),
    'total'                => number_format($sale->total, 2),
    'paid'                 => number_format($sale->payments->sum('tendered') - $sale->payments->sum('change_due'), 2, '.', ''),
    'balance'              => number_format((($sale->payments->sum('tendered') - $sale->payments->sum('change_due')) - $sale->total) * (- 1), 2, '.', ''),
    'payments'             => $paymentsArray,
    'created_at'           => Date::parse($sale->created_at)->toDateTimeString(),
    'updated_at'           => Date::parse($sale->updated_at)->toDateTimeString(),
  ];
});

Route::get('payment-methods', function() {
  $paymentMethods = PaymentMethod::all();
  return $paymentMethods;
});

Route::get('event-types', function() {
  $eventTypes = EventType::where('id', '!=', 1)->orderBy('name', 'asc')->get();
  return $eventTypes;
});

Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user()->id;
});

Route::post('new-sale', function(Request $request) {
  // New Sale
  /*$sale = new Sale;

  $sale->creator_id        = Auth::user()->id;
  $sale->organization_id   = User::find($request->sale->customerId)->organization_id;
  $sale->customer_id       = $request->sale->customer_id;
  $sale->status            = "complete";
  $sale->taxable           = User::find($request->sale->customerId)->organization->type->taxable;
  $sale->subtotal          = number_format($request->sale->subtotal, 2);
  $sale->tax               = number_format($request->sale->tax, 2);
  $sale->total             = number_format($request->sale->total, 2);
  $sale->refund            = false;
  $sale->memo              = "";
  //$sale->first_event_id    = $request->first_event_id;
  //$sale->second_event_id   = $request->second_event_id;



  $sale->source            = "cashier";

  //$sale->save();

  //$sale->events()->attach([$request->first_event_id, $request->second_event_id]);


  // New Payment

  // Store tickets in the database

*/

  return response()->json($request);
});

Route::group(["prefix" =>"public"], function() {
  // This route is responsible for returning available events based on the number of seats available
  Route::get("findAvailableEvents", function(Request $request) {
    $date            = Date::parse($request->date)->format("Y-m-d");
    $seats_needed    = (int)$request->seats;
    $available_events = Event::whereDate("start", $date)->get();
    $events          = collect();
    foreach ($available_events as $available_event)
    {
      $seats_taken     = App\Ticket::where("event_id", $available_event->id)->count();
      $seats_available =  $available_event->seats - $seats_taken;
      $start           = $available_event->start;
      $end             = $available_event->end;

      // This is an array!
      $event = [
        "title" => "Not Available",
        "start" => $start->toDateTimeString(),
        "end"   => $end->toDateTimeString(),
      ];

      $events->push($event);
      $event = [];
    }
    return response([ "data" => $events ]);
    //return [ "data" => $events];
  });
  // This route creates the reservations
  Route::post("createReservation", function(Request $request) {
    // Check for organization, add it if it doesn't exist
    if ($request->schoolId)
      $organization = Organization::find((int)$request->schoolId);
    else
    {
      // I do not trust users. Look for custom entered schools anyway.
      $organization = Organization::where("name", $request->school)->first();

      // If organization really doesnt exist then add it
      if (!$organization)
      {
        $organization             = new Organization;

        $organization->name       = $request->school;
        $organization->address    = $request->address;
        $organization->city       = $request->city;
        $organization->state      = $request->state;
        $organization->country    = "United States";
        $organization->zip        = $request->zip;
        $organization->phone      = $request->phone;
        $organization->fax        = null;
        $organization->email      = str_replace(" ", "", "{$request->school}@astral");
        $organization->website    = null;
        $organization->type_id    = 2;
        $organization->creator_id = 1;

        $organization->save();

        $organization = Organization::where("name", $request->school)->first();
      }

      // Create Organization User Account?
    }

    // Check if user exists, add if he/she doesn't
    $user = User::where("email", $request->email)->first();
    if (!$user)
    {
      $user                  = new User;

      $user->firstname       = $request->firstname;
      $user->lastname        = $request->lastname;
      $user->email           = $request->email;
      $user->type            = "individual";
      $user->role_id         = \App\Role::where("name", "teacher")->first()->id;
      $user->organization_id = $organization->id;
      $user->membership_id   = 1;
      $user->address         = $request->address;
      $user->city            = $request->city;
      $user->state           = $request->state;
      $user->zip             = $request->zip;
      $user->country         = "United States";
      $user->phone           = $request->cell;
      $user->active          = true;
      $user->staff           = false;
      $user->creator_id      = 1;
      $user->password        = bcrypt(str_random(10));

      $user->save();

      $user = User::where("email", $request->email)->first();
    }

    // Create event
    $firstEvent             = new Event;

    $firstEvent->start      = Carbon::parse($request->firstShowTime);
    $firstEvent->end        = $firstEvent->start->addHour();
    $firstEvent->memo       = null;
    $firstEvent->seats      = 180;
    $firstEvent->creator_id = 1;
    $firstEvent->type_id    = EventType::where("name", "School Groups")->first()->id;
    $firstEvent->public     = false;
    $firstEvent->show_id    = Show::find((int)$request->firstShow)->id;

    $firstEvent->save();

    // Add first event to $events array
    $events_array = [];
    array_push($events_array, $firstEvent->id);

    $firstEvent->memo()->create([
      "author_id" => 1,
      "message"   => "Created orgininally for {$user->fullname}, {$organization->name} (website).",
    ]);

    $secondEvent = new Event; // avoid undefined error in json response

    if ($request->secondShowTime)
    {

      $secondEvent->start      = Carbon::parse($request->secondShowTime);
      $secondEvent->end        = $secondEvent->start->addHour();
      $secondEvent->memo       = null;
      $secondEvent->seats      = 180;
      $secondEvent->creator_id = 1;
      $secondEvent->type_id    = EventType::where("name", "School Groups")->first()->id;
      $secondEvent->public     = false;
      $secondEvent->show_id    = Show::find((int)$request->secondShow)->id; // change this to id

      $secondEvent->save();

      // Add first event to $events array
      array_push($events_array, $secondEvent->id);

      $secondEvent->memo()->create([
        "author_id" => 1,
        "message"   => "Created orgininally for {$user->fullname}, {$organization->name} (website).",
      ]);

    }
    // Calculate price

    // if one show
    $teacher_ticket = TicketType::where("name", "Teacher")->first();
    if (!$request->secondShowTime)
    {
      $student_ticket = TicketType::where("name", "Student")->first();
      //$teacher_ticket = TicketType::where("name", "Teacher")->first();
      $parent_ticket  = TicketType::where("name", "Parent")->first();

      $student_subtotal = (double)$request->students * (double)$student_ticket->price;

      $teacher_subtotal = (double)$request->teacher  * (double)$teacher_ticket->price;

      $parent_subtotal  = (double)$request->parents  * (double)$parent_ticket->price;
    }
    // if multishow
    else
    {
      $student_ticket = TicketType::where("name", "Student Multishow")->first();
      //$teacher_ticket = TicketType::where("name", "Teacher")->first();
      $parent_ticket  = TicketType::where("name", "Parent Multishow")->first();

      $student_subtotal = (double)$request->students * (double)$student_ticket->price * 2;

      $teacher_subtotal = (double)$request->teachers * (double)$teacher_ticket->price * 2;

      $parent_subtotal  = (double)$request->parents  * (double)$parent_ticket->price * 2;
    }

    // Need to figure out how to get custom ticket names for this

    // Create sale
    $sale                       = new Sale;

    $sale->creator_id           = 1;
    $sale->status               = "tentative";
    $sale->source               = "website";
    $sale->taxable              = $request->taxable == "true"; // add field for this on frontend
    $sale->subtotal             = (double)($student_subtotal + $teacher_subtotal + $parent_subtotal);
    $sale->tax                  = $sale->taxable == "true" ? ((double)$sale->subtotal * ((double)\App\Setting::find(1)->tax/100)) : 0;
    $sale->total                = (double)$sale->subtotal + (double)$sale->tax;
    $sale->refund               = false;
    $sale->customer_id          = $user->id;
    $sale->organization_id      = $organization->id;
    $sale->sell_to_organization = false;

    $sale->save();

    $sale->memo()->create([
      "author_id" => 1,
      "message" => "Created orgininally for {$user->fullname}, {$organization->name} (website).",
    ]);

    // Atach events to sale

    $sale->events()->attach($events_array);

    // Attach uniview or startalk to sale
    $product = \App\Product::where("name", $request->postShow)->first();

    $sale->products()->attach($product);

    // Add user created memo to sale

    if ($request->memo != null)
    {
      $sale->memo()->create([
        "author_id" => $user->id,
        "message"   => $request->memo,
      ]);
    }

    // Create tickets and attach it to events

    $tickets = [];

    // ** First Event ** //

    // Student Tickets , First Event

    for ($s = 0; $s < (int)$request->students; $s++)
    {
      $tickets = array_prepend($tickets, [
        'ticket_type_id'  => $student_ticket->id,
        'event_id'        => $firstEvent->id    ,
        'customer_id'     => $user->id          ,
        'cashier_id'      => 1                  ,
        'organization_id' => $organization->id  ,
      ]);
    }

    // Teacher Tickets, First Event

    for ($t = 0; $t < (int)$request->teachers; $t++)
    {
      $tickets = array_prepend($tickets, [
        'ticket_type_id'  => $teacher_ticket->id,
        'event_id'        => $firstEvent->id    ,
        'customer_id'     => $user->id          ,
        'cashier_id'      => 1                  ,
        'organization_id' => $organization->id  ,
      ]);
    }

    // Parent Tickets, First Event
    if ((int)$request->parents > 0)
    {
      for ($p = 0; $p < (int)$request->parents; $p++)
      {
        $tickets = array_prepend($tickets, [
          'ticket_type_id'  => $parent_ticket->id,
          'event_id'        => $firstEvent->id   ,
          'customer_id'     => $user->id         ,
          'cashier_id'      => 1                 ,
          'organization_id' => $organization->id ,
        ]);
      }
    }

    // ** Second Event ** //

    if ($request->secondShowTime != null)
    {
      // Student Tickets , Second Event
      for ($s = 0; $s < (int)$request->students; $s++)
      {
        $tickets = array_prepend($tickets, [
          'ticket_type_id'  => $parent_ticket->id,
          'event_id'        => $secondEvent->id  ,
          'customer_id'     => $user->id         ,
          'cashier_id'      => 1                 ,
          'organization_id' => $organization->id ,
        ]);
      }

      // Teacher Tickets, Second Event
      for ($t = 0; $t < (int)$request->teachers; $t++)
      {
        $tickets = array_prepend($tickets, [
          'ticket_type_id'  => $teacher_ticket->id,
          'event_id'        => $secondEvent->id   ,
          'customer_id'     => $user->id          ,
          'cashier_id'      => 1                  ,
          'organization_id' => $organization->id  ,
        ]);
      }

      // Parent Tickets, Second Event
      if ((int)$request->parents > 0)
      {
        for ($p = 0; $p < (int)$request->parents; $p++)
        {
          $tickets = array_prepend($tickets, [
            'ticket_type_id'  => $parent_ticket->id,
            'event_id'        => $secondEvent->id  ,
            'customer_id'     => $user->id         ,
            'cashier_id'      => 1                 ,
            'organization_id' => $organization->id ,
          ]);
        }
      }
    }

    $sale->tickets()->createMany($tickets);

    // Products? (star talk, uniview)

    return response(["message" => [
        "type"         => "success",
        "content"      => "Reservation created successfully!",
      ]]);
  });

  // This route will return shows in the database
  Route::get("shows", function(Request $request) {
    $shows = Show::where("active", true);

    if ($request->type)
    {
      $show_type = \App\ShowType::where("name", $request->type)->first();
      $shows = $shows->where("type_id", $show_type->id);
    }

    $shows = $shows->get();

    $shows_array = [];

    foreach ($shows as $show)
    {
      array_push($shows_array, [
        "id"          => $show->id,
        "name"        => $show->name,
        "type"        => $show->category->name,
        "description" => $show->description,
        "cover"       => $show->cover,
        "duration"    => (int)$show->duration,
      ]);
    }

    return response([
      "data" => $shows_array
    ]);
  });
  // This route will return shows in the database
  Route::get("organizations", function(Request $request) {
    $organizations = Organization::where("id", "!=", 1)->get();
    $organization_array = [];
    foreach ($organizations as $organization)
    {
      array_push($organization_array, [
        "id"   => $organization->id,
        "name" => $organization->name,
        "type" => $organization->type->name,
      ]);
    }
    return response([
      "data" => $organization_array
    ]);
  });
});
