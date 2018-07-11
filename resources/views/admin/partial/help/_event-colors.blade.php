@component('admin.partial._modal',
  [
    'id' => 'event-colors',
    'icon' => 'info circle',
    'title' => 'Help',
    'subtitle' => 'Event Colors',
  ]
)
  @slot('content')

    @foreach (App\EventType::where('id', '!=', 1)->get() as $eventType)
      <div class="ui inverted segment" style="background-color: {{ $eventType->color }} !important">
        <div class="ui small header">
          <div class="content">
            {{ $eventType->name }}</div>
            <div class="sub header">
              {{ $eventType->description }}
            </div>
            <div class="sub header">
              @foreach ($eventType->allowedTickets as $ticketType)
                <div class="ui black label">
                  <i class="ticket icon"></i>
                  <div class="detail">{{ $ticketType->name }}</div>
                  @if ($ticketType->in_cashier)
                    <div class="detail" data-tooltip="{{ $ticketType->name }} tickets are available in cashier."><i class="inbox icon"></i></div>
                  @endif
                </div>
              @endforeach
            </div>
          </div>
      </div>
    @endforeach

    @if (Request::routeIs('admin.calendar.sales'))
      <div class="ui inverted segment" style="background-color: red !important">
        <div class="ui small header">
          <div class="content">Canceled</div>
            <div class="sub header">
              Sales marked with this color have been canceled.
            </div>
          </div>
      </div>
    @endif

  @endslot
@endcomponent
