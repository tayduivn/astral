@extends('layout.admin')

@section('title', 'Calendar')

@section('subtitle', null)

@section('icon', 'calendar')

@section('content')

  <div class="ui black icon buttons">
    <div onclick="$('#admin-calendar').fullCalendar('prev')" class="ui button"><i class="left chevron icon"></i></div>
    <div onclick="$('#admin-calendar').fullCalendar('today')" class="ui button"><i class="checked calendar icon"></i></div>
    <div onclick="$('#admin-calendar').fullCalendar('next')" class="ui button"><i class="right chevron icon"></i></div>
  </div>

  <a class="ui secondary button" href="javascript:$('#create-event').modal('show')">
    <i class="calendar plus icon"></i> Create Event
  </a>

  <div class="ui floating secondary dropdown button">
    <i class="plus icon"></i> Create Sale<i class="dropdown icon"></i>
    <div class="menu">
      @foreach (App\EventType::where('id', '!=', 1)->get() as $eventType)
        <a href="{{ route('admin.sales.create') }}?eventType={{ $eventType->id }}" class="item">{{ $eventType->name }}</a>
      @endforeach
    </div>
  </div>

  <div class="ui right floated secondary floating dropdown labeled icon button">
    <i class="eye icon"></i>
    <span class="text">Week</span>
    <div class="menu">
      <div onclick="$('#admin-calendar').fullCalendar('changeView', 'agendaDay')" class="{{ $request->view == 'agendaDay' ? 'active' : null }} item">Single Day</div>
      <div onclick="$('#admin-calendar').fullCalendar('changeView', 'agendaWeek')" class="{{ $request->view == 'agendaWeek' ? 'active' : null }} item">Week</div>
      <div onclick="$('#admin-calendar').fullCalendar('changeView', 'month')" class="{{ $request->view == 'month' ? 'active' : null }} item">Month</div>
    </div>
  </div>

  <div class="ui right floated secondary floating dropdown labeled icon button">
    <i class="calendar outline icon"></i>
    <span class="text">{{ $request->type == 'events' ? 'Events' : 'Reservations' }}</span>
    <div class="menu">
      @if (isSet($request))
        <div onclick="toggleCalendar('events')" class="{{ $request->type == 'events' ? 'active' : null }} item">Events</div>
        <div onclick="toggleCalendar('calendar')" class="{{ $request->type == 'calendar' ? 'active' : null }} item">Reservations</div>
      @else
        <div onclick="toggleCalendar('events')" class="item">Events</div>
        <div onclick="toggleCalendar('calendar')" class="active item">Reservations</div>
      @endif
    </div>
  </div>

  @if (!isset($events) || count($events) > 0)
    <br /><br /><br />
    <div class="ui doubling stackable grid">
      <div id="admin-calendar" style="min-width:100%; max-width:100%; padding-bottom: 2rem"></div>
    </div>
  @else
    <div class="ui info icon message">
      <i class="info circle icon"></i>
      <i class="close icon"></i>
      <div class="content">
        <div class="header">
          No events!
        </div>
        <p>It looks like there are no events in the database.</p>
      </div>
    </div>
  @endif

  @include('admin.partial.events._create')

<script>

  function loadCalendar() {
    $('#admin-calendar').fullCalendar({
      header: false,
      views: null,
      defaultView: 'agendaWeek',
      defaultDate: moment().format('YYYY-MM-DD'),
      contentHeight: 'auto',
      hiddenDays: [0],
      navLinks: true,
      editable: false,
      eventLimit: true,
      minTime: '07:00:00',
      @if (isSet($request->type))
      // events: '/api/{{ $request->type }}',
      eventColor: '{{ $request->type == 'calendar' ? '#1b1c1d' : '#002e5d' }}'
      @else
      // events: '/api/calendar',
      @endif

    })
  }

  function toggleCalendar(type) {
    $('#admin-calendar').fullCalendar('removeEventSources')
    var color = type == 'calendar' ? '#1b1c1d' : '#002e5d'
    $('#admin-calendar').fullCalendar('option', 'eventColor', color)
    $('#admin-calendar').fullCalendar('addEventSource', '/api/' + type)
  }

  function refetchEvents() {
    $('#admin-calendar').fullCalendar('refetchEvents')
  }

  function setTitle() {
    var title = $('#admin-calendar').fullCalendar('getView').title
    $('.header.active.item.hide-on-mobile').html('<i class="calendar icon"></i> Calendar | {{ App\Setting::find(1)->organization }} | <strong>' + title + '</strong>')
  }

  //$(document).ready(loadCalendar)

  $(document).ready(function() {
    loadCalendar()
    $('#admin-calendar').fullCalendar('addEventSource', '/api/{{ $request->type }}')
    setTitle()
    @if (isSet($request->view))
      $('#admin-calendar').fullCalendar('changeView', '{{ $request->view }}')
    @endif
    @if (isSet($request->date))
      $('#admin-calendar').fullCalendar('gotoDate', $.fullCalendar.moment('{{ $request->date }}'))
    @endif
  })

  $('.ui.button').click(setTitle)


  setInterval(refetchEvents, 5000)


</script>

@endsection
