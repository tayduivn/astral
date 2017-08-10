@extends('layout.admin')

@section('title', 'Sale Information | Sale #'.$sale->id)

@section('content')

  @if ($sale->refund)
  <h2 class="ui red dividing header">
  @else
  <h2 class="ui dividing header">
  @endif
    <i class="dollar icon"></i>
    <div class="content">
      Sale # {{ $sale->id }}
      @if ($sale->refund)
        <div class="ui red label"><i class="refresh icon"></i> Refund</div>
      @endif
      <div class="sub header">
        by {{ $sale->cashier->firstname }} {{ $sale->cashier->lastname }}
        on {{ Date::parse($sale->created_at)->format('l, F j, Y \a\t g:i A') }}
        ({{ Date::parse($sale->created_at)->diffForHumans() }})
      </div>
      @if ($sale->refund)
      <div class="sub header">
        <strong>Refunded on {{ Date::parse($sale->updated_at)->format('l, F j, Y \a\t g:i A') }} ({{ Date::parse($sale->updated_at)->diffForHumans() }})</strong>
      </div>
      @endif
    </div>
  </h2>

  @if (! $sale->refund)
  <div class="ui right floated buttons">
    <a href="javascript:$('#refund-modal').modal('show')" class="ui red button"><i class="refresh icon"></i> Refund</a>
  </div>
  @endif
  <div class="ui left floated buttons">
    <a href="#" class="ui default button">
      <i class="left chevron icon"></i> Back
    </a>
  </div>

  <br /><br /><br />

  <div class="ui two column grid">
    <div class="column">
      @if ($sale->refund)
      <h2 class="ui red header">
      @else
      <h2 class="ui header">
      @endif
        <div class="sub header">Sale #</div>
        {{ $sale->id }}
      </h2>

      @if ($sale->refund)
      <h2 class="ui red header">
      @else
      <h2 class="ui header">
      @endif
        <div class="sub header">Source</div>
        {{ $sale->source }}
      </h2>

      @if ($sale->refund)
      <h2 class="ui red header">
      @else
      <h2 class="ui header">
      @endif
        <div class="sub header">Created on</div>
        {{ Date::parse($sale->created_at)->format('l, F j, Y \a\t g:i A') }}
        ({{ Date::parse($sale->created_at)->diffForHumans() }})
      </h2>

      @if ($sale->refund)
      <h2 class="ui red header">
      @else
      <h2 class="ui header">
      @endif
        <div class="sub header">Updated on</div>
        {{ Date::parse($sale->updated_at)->format('l, F j, Y \a\t g:i A') }}
        ({{ Date::parse($sale->updated_at)->diffForHumans() }})
      </h2>

      @if ($sale->refund)
      <h2 class="ui red header">
      @else
      <h2 class="ui header">
      @endif
        <div class="sub header">Memo</div>
        {{ $sale->memo }}
      </h2>

    </div>
    <div class="column">
      @if ($sale->refund)
      <h2 class="ui red header">
      @else
      <h2 class="ui header">
      @endif
        <div class="sub header">Payment Method</div>
        @if ($sale->payment_method == 'visa')
          <i class="visa icon"></i>
        @elseif ($sale->payment_method == 'mastercard')
          <i class="mastercard icon"></i>
        @elseif ($sale->payment_method == 'discover')
          <i class="discover icon"></i>
        @elseif ($sale->payment_method == 'american express')
          <i class="american express icon"></i>
        @else
          <i class="money icon"></i>
        @endif
      </h2>

      @if ($sale->reference)
        @if ($sale->refund)
        <h2 class="ui red header">
        @else
        <h2 class="ui header">
        @endif
        <div class="sub header">Reference</div>
        {{ $sale->reference }}
      </h2>
      @endif

      @if ($sale->refund)
      <h2 class="ui red header">
      @else
      <h2 class="ui header">
      @endif
        <div class="sub header">Subtotal</div>
        $ {{ number_format($sale->subtotal, 2) }}
      </h2>

      @if ($sale->refund)
      <h2 class="ui red header">
      @else
      <h2 class="ui header">
      @endif
        <div class="sub header">Tax</div>
        $ {{ number_format($sale->total - $sale->subtotal, 2) }}
      </h2>

      @if ($sale->refund)
      <h2 class="ui red header">
      @else
      <h2 class="ui header">
      @endif
        <div class="sub header">Total</div>
        $ {{ number_format($sale->total, 2) }}
      </h2>

      @if ($sale->refund)
      <h2 class="ui red header">
      @else
      <h2 class="ui header">
      @endif
        <div class="sub header">Tendered</div>
        $ {{ number_format($sale->tendered, 2) }}
      </h2>

      @if ($sale->refund)
      <h2 class="ui red header">
      @else
      <h2 class="ui header">
      @endif
        <div class="sub header">Change Due</div>
        $ {{ number_format($sale->change_due, 2) }}
      </h2>

    </div>
  </div>

  <div class="ui horizontal divider header">
    <i class="ticket icon"></i>
    Tickets
  </div>

  <div class="ui basic segment">
    @if ($sale->refund)
    <table class="ui celled selectable inverted red padded striped table">
    @else
    <table class="ui celled selectable padded striped table">
    @endif
      <thead>
        <tr>
          <th class="single line">Ticket Number</th>
          <th>Type</th>
          <th>Show Name</th>
          <th>Show Date</th>
          <th>Sale #</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sale->tickets as $ticket)
        <tr>
          <th><h3 class="ui inverted center aligned header">{{ $ticket->id }}</h3></th>
          <th>{{ $ticket->type }}</th>
          <th>{{ App\Event::find($ticket->event_id)->show->name }}</th>
          <th>{{ Date::parse($ticket->created_at)->format('l, F j, Y \a\t g:i A') }}</th>
          <th>{{ $sale->id }}</th>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- Refund Modal -->
  <div class="ui basic modal" id="refund-modal">
    <div class="ui icon header">
      <i class="refresh icon"></i>
      Refund
      <div class="sub header" style="color:white">Please confirm sale information</div>
    </div>
    <div class="content">
      {!! Form::open(['route' => ['admin.sales.refund', $sale], 'class' => 'ui form', 'id' => 'refund']) !!}
      <div class="inverted segment">
        @if ($sale->reference)
        <div class="four fields">
        @else
        <div class="three fields">
        @endif
          <div class="field">
            {!! Form::label('id', 'Sale Number') !!}
            {!! Form::text('id', null, ['placeholder' => 'Sale Number']) !!}
          </div>
          <div class="field">
            {!! Form::label('total', 'Sale Total') !!}
            <div class="ui labeled input">
              <div class="ui label">$</div>
              {!! Form::text('total', null, ['placeholder' => 'Sale Total']) !!}
            </div>

          </div>
          <div class="field">
            {!! Form::label('payment_method', 'Sale Payment Method') !!}
            <div class="ui selection dropdown">
              {!! Form::hidden('payment_method', null, ['id' => 'payment_method']) !!}
              <i class="dropdown icon"></i>
              <div class="default text">Payment Method</div>
              <div class="menu">
                <div class="item" data-value="cash"><i class="money icon"></i>Cash</div>
                <div class="item" data-value="visa"><i class="visa icon"></i>Visa</div>
                <div class="item" data-value="mastercard"><i class="mastercard icon"></i>Mastercard</div>
                <div class="item" data-value="discover"><i class="discover icon"></i>Discover</div>
                <div class="item" data-value="american express"><i class="american express icon"></i>American Express</div>
                <div class="item" data-value="check"><i class="check icon"></i>Check</div>
              </div>
            </div>
          </div>
          @if ($sale->reference)
          <div class="field">
            {!! Form::label('reference', 'Reference') !!}
            {!! Form::text('reference', null, ['placeholder' => 'Check or Credit Card #']) !!}
          </div>
          @endif
        </div>
        <div class="field">
          {!! Form::label('memo', 'Memo') !!}
          {!! Form::textarea('memo', null, ['placeholder' => 'Explain why you had to give a refund']) !!}
        </div>
      </div>
    </div>
    <div class="actions">
      <div class="ui standard inverted button">
        <i class="eraser icon"></i>
        Clear Form
      </div>
      {!! Form::button('<i class="refresh icon"></i> Refund', ['type' => 'submit', 'class' => 'ui yellow inverted button', 'id' => 'submit-refund']) !!}
    </div>
    {!! Form::close() !!}
  </div>

  <script>

  $('button#submit-refund').click(function() {
    $('#refund.ui.form')
      .form({
        fields: {
          id             : ['is[{{ $sale->id }}]', 'empty'],
          total          : ['is[{{ $sale->total }}]', 'empty'],
          payment_method : ['is[{{ $sale->payment_method }}]', 'empty'],
          @if ($sale->reference)
          reference      : ['is[{{ $sale->reference }}]', 'empty'],
          @endif
          memo           : ['minLength[10]', 'empty']
        }
    });
  });
  </script>

@endsection
