
<div class="two fields">
  <div class="inline required field">
    {!! Form::label('status', 'Status') !!}
    <div class="ui selection dropdown" id="sale-status">
      @if (old('status') == null)
        <input type="hidden" id="status" name="status" value="open">
      @elseif (isSet($sale))
        <input type="hidden" id="status" name="status" value={{ $sale->status }}>
      @else
        <input type="hidden" id="status" name="status" value="{{ old('status') }}">
      @endif
      <i class="dropdown icon"></i>
      <div class="default text">Sale Status</div>
      <div class="menu">
        <div class="item" data-value="open"><i class="unlock icon"></i>Open</div>
        <div class="item" data-value="complete"><i class="checkmark icon"></i>Complete</div>
        <div class="item" data-value="canceled"><i class="remove icon"></i>Canceled</div>
        <div class="item" data-value="tentative"><i class="help icon"></i>Tentative</div>
        <div class="item" data-value="no show"><i class="thumbs outline down icon"></i>No Show</div>
      </div>
    </div>
  </div>
  <div class="field">
    <div class="ui right floated buttons">
      <a href="{{ route('cashier.sales.index') }}" class="ui default button"><i class="left chevron icon"></i> Back</a>
      {!! Form::button('<i class="save icon"></i> Save', ['type' => 'submit', 'class' => 'ui secondary button']) !!}
    </div>
  </div>
</div>
<div class="five fields">
  <div class="field">
    {!! Form::label('subtotal', 'Subtotal' ) !!}
    <div class="ui labeled input">
      <div class="ui label">$ </div>
      @if (isSet($sale))
        {!! Form::text('subtotal', number_format($sale->subtotal, 2), ['placeholder' => 'Subtotal', 'readonly' => true]) !!}
      @else
        {!! Form::text('subtotal', number_format(0, 2), ['placeholder' => 'Subtotal', 'readonly' => true]) !!}
      @endif
    </div>
  </div>
  <div class="field">
    {!! Form::label('tax', 'Tax ('. App\Setting::find(1)->tax .'%)') !!}
    <div class="ui labeled input">
      <div class="ui label">$ </div>
      @if (isSet($sale))
        {!! Form::text('tax', number_format($sale->tax, 2), ['placeholder' => 'Tax', 'readonly' => true]) !!}
      @else
        {!! Form::text('tax', number_format(0, 2), ['placeholder' => 'Tax', 'readonly' => true]) !!}
      @endif
    </div>
  </div>
  <div class="field">
    {!! Form::label('total', 'Total') !!}
    <div class="ui labeled input">
      <div class="ui label">$ </div>
      @if (isSet($sale))
        {!! Form::text('total', number_format($sale->total, 2), ['placeholder' => 'Total', 'readonly' => true]) !!}
      @else
        {!! Form::text('total', number_format(0, 2), ['placeholder' => 'Total', 'readonly' => true]) !!}
      @endif
    </div>
  </div>
  <div class="field">
    <label for="paid">Paid</label>
    <div class="ui labeled input">
      <div class="ui label">$ </div>
      <input type="text" id="paid" name="paid" value="{{ isSet($sale) ? number_format($sale->payments->sum('tendered'), 2) : number_format(0, 2) }}" readonly>
    </div>
  </div>
  <div class="field">
    <label for="paid">Balance</label>
    <div class="ui labeled input">
      <div class="ui label">$ </div>
      <input type="text" id="balance" name="balance" value="{{ isSet($sale) ? number_format($sale->total - $sale->payments->sum('tendered'), 2) : number_format(0, 2) }}" readonly>
    </div>
  </div>
</div>
<div class="ui two column doubling stackable grid">
  <div class="column">
    <div class="ui segment">
      <div class="ui dividing header"><i class="dollar sign icon"></i>Sale Information</div>
      <div class="required field">
        {!! Form::label('organization_id', 'Organization') !!}
        @if (isSet($sale))
          {!! Form::select('organization_id', $organizations, $sale->organization->id, ['class' => 'ui selection search scrolling dropdown']) !!}
        @else
          {!! Form::select('organization_id', $organizations, 1, ['class' => 'ui selection search scrolling dropdown']) !!}
        @endif

      </div>
      <div class="required field">
        {!! Form::label('customer_id', 'Customer') !!}
        <div class="ui selection search scrolling dropdown" id="customers">
          @if (isSet($sale))
            <input type="hidden" id="customer_id" name="customer_id" value="{{ $sale->customer_id }}">
          @else
            <input type="hidden" id="customer_id" name="customer_id" value="1">
          @endif

          <div class="default text">Select a Customer</div>
          <i class="dropdown icon"></i>
          <div class="menu" id="users">
            @if (isSet($sale))
              @foreach ($sale->organization->users as $customer)
                <div class="item" data-value="{{ $customer->id }}">
                  {{ $customer->firstname . ' ' . $customer->lastname }}
                </div>
              @endforeach
            @else
              <div class="item" data-value="1">Walk-up</div>
            @endif
          </div>
        </div>
      </div>
      <div class="required field">
        {{ Form::label('first_event_id', 'First Event') }}
        <div class="ui selection search scrolling dropdown" id="first-event">
          @if (old('first_event_id') == null)
            <input type="hidden" id="first_event_id" name="first_event_id" value="0">
          @else
            <input type="hidden" id="first_event_id" name="first_event_id" value="{{ old('first_event_id') }}">
          @endif
          <i class="dropdown icon"></i>
          @if(count($events) == 0)
            <div class="default text">
              <i class="info circle icon"></i>No events were found! You need to create an event for your sale =)
            </div>
          @else
            <div class="default text">Select the first event</div>
          @endif
          <div class="menu">
            @foreach($events as $event)
              <div class="item" data-value="{{ $event->id }}">
                <strong>{{ $event->show->name }}</strong>
                on <em>{{ Date::parse($event->start)->format('l, F j, Y \a\t g:i A') }}</em>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="field">
        {{ Form::label('second_event_id', 'Second Event') }}
        <div class="ui selection search scrolling dropdown" id="second-event">
          @if (old('second_event_id') == null)
            <input type="hidden" id="second_event_id" name="second_event_id" value="1">
          @else
            <input type="hidden" id="second_event_id" name="second_event_id" value="{{ old('second_event_id') }}">
          @endif
          <i class="dropdown icon"></i>
          <div class="default text">Select the second event (optional)</div>
          <div class="menu">
            <div class="item" data-value="1">
              No Show
            </div>
            @foreach($events as $event)
              <div class="item" data-value="{{ $event->id }}">
                <strong>{{ $event->show->name }}</strong>
                on <em>{{ Date::parse($event->start)->format('l, F j, Y \a\t g:i A') }}</em>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <table class="ui selectable single line very compact table">
        <thead>
          <tr class="header">
            <th>Ticket Type</th>
            <th>Amount / Price</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($ticketTypes as $ticketType)
          <tr>
            <td>
              <h4 class="ui header">
                <i class="ticket icon"></i>
                <div class="content">
                  {{ $ticketType->name }}
                  <div class="sub header">{{ $ticketType->description }}</div>
                </div>
              </h4>
            </td>
            <td>
              <div class="ui right labeled input">
                @if (isSet($sale))
                  {!! Form::text('ticket['. $ticketType->id .']', $sale->tickets->where('event_id', $sale->events[0]->id)->where('ticket_type_id', $ticketType->id)->count(), ['placeholder' => 'Amount of '. $ticketType->name . ' tickets', 'size' => 1, 'class' => 'ticket-type']) !!}
                @else
                  {!! Form::text('ticket['. $ticketType->id .']', 0, ['placeholder' => 'Amount of '. $ticketType->name . ' tickets', 'size' => 1, 'class' => 'ticket-type']) !!}
                @endif
                <div class="ui label" id="ticket-price">$ {{ number_format($ticketType->price, 2) }} each</div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="column">
    <div class="ui segment">
      <div class="ui dividing header"><i class="info circle icon"></i>Payment Information</div>
      <div class="required field">
        {!! Form::label('taxable', 'Taxable') !!}
        @if (isSet($sale))
          {!! Form::select('taxable', [false => 'No', true => 'Yes'], $sale->taxable, ['class' => 'ui dropdown']) !!}
        @else
          {!! Form::select('taxable', [false => 'No', true => 'Yes'], true, ['class' => 'ui dropdown']) !!}
        @endif
      </div>
      <div class="three fields">
        <div class="field">
          {!! Form::label('payment_method_id', 'Payment Method') !!}
          <div class="ui fluid selection dropdown">
            <input type="hidden" id="payment_method_id" name="payment_method_id" value="{{ old('payment_method_id') }}">
            <i class="dropdown icon"></i>
            <div class="default text">Select Payment Method</div>
            <div class="menu">
              @foreach ($paymentMethods as $paymentMethod)
              <div class="item" data-value="{{ $paymentMethod->id }}">
                <i class="{{ $paymentMethod->icon }} icon"></i> {{ $paymentMethod->name }}
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="field">
          {!! Form::label('tendered', 'Tendered') !!}
          <div class="ui labeled input">
            <div class="ui label">$ </div>
            {!! Form::text('tendered', number_format(0, 2), ['placeholder' => 'Tendered']) !!}
          </div>
        </div>
        <div class="field">
          {!! Form::label('change_due', 'Change Due') !!}
          <div class="ui labeled input">
            <div class="ui label">$ </div>
            {!! Form::text('change_due', number_format(0, 2), ['placeholder' => 'Change due', 'readonly' => true]) !!}
          </div>
        </div>
      </div>
      <div class="field">
        {!! Form::label('reference', 'Reference') !!}
        {!! Form::text('reference', null, ['placeholder' => 'Credit Card or Check reference.']) !!}
      </div>
      <table class="ui selectable single line table">
        <thead>
          <tr class="payments">
            <th>#</th>
            <th>Method</th>
            <th>Amount Paid</th>
            <th>Date</th>
            <th>Cashier</th>
          </tr>
        </thead>
        <tbody>
          <tr class="warning center aligned payments">
            @if (isSet($sale))
              @if(count($sale->payments) > 0)
                @foreach($sale->payments as $payment)
                  <tr class="payments">
                    <td><div class="ui header">{{ $payment->id }}</div></td>
                    <td>{{ $payment->method->name }}</td>
                    <td>{{ number_format($payment->tendered, 2) }}</td>
                    <td>{{ Date::parse($payment->created_at)->format('l, F j, Y \a\t g:i A') }}</td>
                    <td>{{ $payment->cashier->firstname }}</td>
                  </tr>
                @endforeach
              @else
                <tr class="warning center aligned">
                  <td colspan="5"><i class="info circle icon"></i> No payments have been received so far</td>
                </tr>
              @endif
            @else
              <tr class="warning center aligned">
                <td colspan="5"><i class="info circle icon"></i> No payments have been received so far</td>
              </tr>
            @endif
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br /><br />
<div class="field">
  {!! Form::label('memo', 'Memo') !!}
  {!! Form::textarea('memo', null, ['placeholder' => 'Write a memo here']) !!}
</div>


<script>

  // Auto Select Taxable
  function autoSelectTaxable() {
    var taxable = document.querySelector('#istaxable').value
    $('#taxable').val(taxable).change()
  }

  function fetchUsers() {
    var organization_id = document.querySelector("#organization_id").value
    $("#users").empty()
    $("#customers").dropdown('clear')
    fetch('/api/organizations/' + organization_id)
      .then((response) => response.json())
      .then((users) => {
        users.map((user, index) => {
          $("#users").append("<div class='item' data-value=" + user.id + ">" + user.name + "</div>")
          $('#taxable').dropdown('set selected', user.taxable)
        })
      })
      .catch((error) => console.log(error))
  }

  // Hide Unwanted Ticket Types
  //$('#organization_id').change(autoSelectTaxable)

  $("#organization_id").change(function() {
    fetchUsers()
    calculateTotals()
  })

  // Calculating Totals

  function calculateTotals() {

    var ticketTypeBoxes = document.querySelectorAll('.ticket-type')
    // ui.tag.label
    var ticketPrice = document.querySelectorAll('#ticket-price')
    var subtotalBox = document.querySelector('#subtotal')
    var subtotalArray = [];
    var subtotal = 0;
    var taxBox = document.querySelector('#tax')
    var tax = 0
    var totalBox = document.querySelector('#total')
    var total = 0
    var taxable = document.querySelector('#taxable')
    var secondShow = document.querySelector('#second_event_id')
    var changeDue = 0
    var changeDueBox = document.querySelector('#change_due')
    var tenderedBox = document.querySelector('#tendered')
    var tendered = parseFloat(tenderedBox.value)

    @if (isSet($sale))
      var paid = {{ number_format($sale->payments->sum('tendered'), 2) }}
    @else
      var paid = 0
    @endif

    var paidBox = document.querySelector('#paid')
    var balance = 0
    var balanceBox = document.querySelector('#balance')

    ticketTypeBoxes.forEach(function(item, index) {
      subtotalArray[index] = ticketTypeBoxes[index].value * parseFloat(ticketPrice[index].innerHTML.split(" ")[1])
    })

    subtotal = subtotalArray.reduce(function(accumulator, currentValue) {
      return accumulator + currentValue
    })

    subtotal = secondShow.value == "1" ? subtotal : subtotal * 2

    subtotalBox.value = subtotal.toFixed(2)

    tax = taxable.value == '1' ? subtotal * ({{ App\Setting::find(1)->tax }} / 100) : 0

    tax = Number(Math.round(tax+'e2')+'e-2')

    taxBox.value = tax.toFixed(2)
    total = subtotal + tax
    totalBox.value = total.toFixed(2)

    balance = total - (paid + tendered)
    balanceBox.value = balance <= 0 ? (0).toFixed(2) : balance.toFixed(2)

    changeDue = tendered - total
    changeDueBox.value = changeDue <= 0 ? (0).toFixed(2) : changeDue.toFixed(2)

  }

  $(document).ready(function() {
    calculateTotals()
    fetchUsers()
    @if (isSet($sale))
      $("#customers").dropdown('set selected', {{ $sale->customer_id }})
      $("#first-event").dropdown('set selected', {{ $sale->events[0]->id }})
      $("#second-event").dropdown('set selected', {{ $sale->events[1]->id }})
      $("#sale-status").dropdown('set selected', '{{ $sale->status }}')
    @else
      $("#customers").dropdown('set selected', 1)
    @endif
  })

  $('.ticket-type').keyup(calculateTotals)
  $('#taxable').change(calculateTotals)
  $('#first_event_id').change(calculateTotals)
  $('#second_event_id').change(calculateTotals)
  $('#tendered').keyup(calculateTotals)

</script>
