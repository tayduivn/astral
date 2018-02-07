{!! Form::open(['route' => 'admin.events.store', 'class' => 'ui form']) !!}
@if (Request::routeIs('admin.events.create'))
<div class="field">
  <div class="ui buttons">
    <a href="{{ route('admin.events.index') }}" class="ui default button"><i class="left chevron icon"></i> Back</a>
    {!! Form::button('Save <i class="checkmark icon"></i>', ['type' => 'submit', 'class' => 'ui positive right labeled icon button']) !!}
  </div>
</div>
@endif
<div class="three required fields">
  <div class="field">
    {!! Form::label('show_id', 'Show') !!}
    {!! Form::select('show_id', $shows, null, ['placeholder' => 'Select a show', 'class' => 'ui search dropdown']) !!}
  </div>
  <div class="field">
    {!! Form::label('type_id', 'Type') !!}
    {!! Form::select('type_id', $eventTypes, null, ['placeholder' => 'Select event type', 'class' => 'ui dropdown']) !!}
  </div>
  <div class="field">
    {!! Form::label('seats', 'Seats') !!}
    {!! Form::text('seats', App\Setting::find(1)->seats, ['placeholder' => 'Number of seats']) !!}
  </div>
</div>
<div class="two required fields">
  <div class="field">
      {!! Form::label('start', 'Start Date and Time') !!}
      <div class="ui left icon input">
        <input placeholder="Event Date and Time" name="dates[0][start]" type="text" readonly="readonly">
        <i class="calendar icon"></i>
    </div>
  </div>
  <div class="field">
    {!! Form::label('end', 'End Date and Time') !!}
    <div class="ui left icon input">
      <input placeholder="Event Date and Time" name="dates[0][end]" type="text" readonly="readonly">
      <i class="calendar icon"></i>
    </div>
  </div>
</div>
<div id="extra-dates"></div>
<div class="field">
  <div class="ui button" id="add-another-date"><i class="plus icon"></i>Add Another Date</div>
</div>
<div class="required field">
  {!! Form::label('memo', 'Memo') !!}
  {!! Form::textarea('memo', null, ['placeholder' => 'Write a memo here']) !!}
</div>
<div class="field">
  @if (Request::routeIs('admin.events.create'))
  <div class="ui buttons">
    <a href="{{ route('admin.events.index') }}" class="ui default button"><i class="left chevron icon"></i> Back</a>
    {!! Form::button('Save <i class="checkmark icon"></i>', ['type' => 'submit', 'class' => 'ui positive right labeled icon button']) !!}
  </div>
  @else
    {!! Form::button(' Save <i class="checkmark icon"></i>', ['type' => 'submit', 'class' => 'ui positive right floated right labeled icon button']) !!}
  @endif
</div>
{!! Form::close() !!}

<script>

  $('.ui.form').form({ fields: { seats: ['number', 'empty'] }});

  var simplemde = new SimpleMDE({
      element: document.getElementById('memo'),
      toolbar: false
  });

  $('[name="dates[0][start]"]').flatpickr({enableTime:true, minDate: 'today', dateFormat: 'l, F j, Y h:i K', defaultHour:8, defaultMin:0});
  $('[name="dates[0][end]"]').flatpickr({enableTime:true, minDate: 'today', dateFormat: 'l, F j, Y h:i K'});

  $('[name="dates[0][start]"]').change(function() {
    document.querySelector('[name="dates[0][end]"]').value = moment(this.value, 'dddd, MMMM D, YYYY h:mm A').add(1, 'hours').format('dddd, MMMM D, YYYY h:mm A');
  })

  var index = 0

  $('#add-another-date').click(function() {
    if (document.querySelector('[name="dates[' + index + '][start]"]').value == "") {
      alert("Please select a date and time for the event before adding a new one.")
    } else {
      index++
      $('#extra-dates').append(
      '<div class="two required fields">' +
        '<div class="field">' +
            '{!! Form::label("start", "Start Date and Time") !!}' +
            '<div class="ui left icon input">' +
              '<input placeholder="Event Date and Time" name="dates['+ index +'][start]" type="text" readonly="readonly">' +
            '<i class="calendar icon"></i>' +
          '</div>' +
        '</div>' +
        '<div class="field">' +
          '{!! Form::label("end", "End Date and Time") !!}' +
          '<div class="ui left icon input">' +
            '<input placeholder="Event Date and Time" name="dates['+ index +'][end]" type="text" readonly="readonly">' +
            '<i class="calendar icon"></i>' +
          '</div>' +
        '</div>' +
      '</div>'
    )

    $('[name="dates[' + index + '][start]"]').flatpickr({
      enableTime:true,
      minDate: 'today',
      dateFormat: 'l, F j, Y h:i K',
      defaultHour:8,
      defaultMin:0,
      onChange: function(selectedDates, dateStr, instance) {
        document.querySelector('[name="dates[' + index + '][end]"]').value = moment(dateStr, 'dddd, MMMM D, YYYY h:mm A').add(1, 'hours').format('dddd, MMMM D, YYYY h:mm A')
      }
    })

    $('[name="dates[' + index + '][end]"]').flatpickr({
      enableTime: true,
      minDate:    'today',
      dateFormat: 'l, F j, Y h:i K'
    })
  }
})


</script>