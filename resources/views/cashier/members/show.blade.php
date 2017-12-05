@extends('layout.cashier')

@section('title', 'Member Information')

@section ('name', $member->users[0]->firstname.' '.$member->users[0]->lastname)

@section ('icon', 'address card')

@section('content')

  <div class="ui buttons">
    <a href="{{ route('cashier.members.index') }}" class="ui default button">
      <i class="left chevron icon"></i> Back
    </a>
    <a href="{{ route('cashier.users.edit', $member->users[0]) }}" class="ui primary button">
      <i class="edit icon"></i> Edit Member
    </a>
    <a href="{{ route('cashier.members.show', $member) }}" class="ui secondary button"><i class="plus icon"></i> Add Another Member</a>
  </div>

  <div class="ui unstackable items">
    <div class="item">
      <i class="address card massive icon"></i>
      <div class="content">
        <h1 class="ui huge header">
          {{ $member->users[0]->firstname }} {{ $member->users[0]->lastname }}
          <div class="sub header"># {{ $member->id }}</div>
          <div class="sub header">{{ $member->users[0]->email }}</div>
        </h1>
        <div class="meta">
          <div class="ui label">{{ $member->type->name }}</div>
        </div>
        <div class="meta">
          <i class="checked calendar icon"></i>
          Expires {{ Date::parse($member->end)->format('l, F j, Y') }}
        </div>
        <div class="description">
          <p>Created on {{ Date::parse($member->created_at)->format('l, F j, Y \a\t h:i:s A') }} ({{ Date::parse($member->created_at)->diffForHumans()}})</p>
          <p>Updated on {{ Date::parse($member->updated_at)->format('l, F j, Y \a\t h:i:s A') }} ({{ Date::parse($member->updated_at)->diffForHumans()}})</p>
        </div>
        <div class="extra"></div>
      </div>
    </div>
  </div>

  <div class="ui buttons">
    <a href="javascript:$('#dependent').modal('show')" class="ui default button">
      <i class="plus icon"></i> Add a Dependent
    </a>
    <a href="{{ route('cashier.members.edit', $member) }}" class="ui primary button">
      <i class="refresh icon"></i> Renew Membership
    </a>
    <a href="{{ route('cashier.members.receipt', $member) }}" target="_blank" class="ui secondary button">
      <i class="file text icon"></i> View Membership Receipt
      <i class="right chevron icon"></i>
    </a>
    <a href="{{ route('cashier.members.card', $member) }}" target="_blank" class="ui yellow button">
      <i class="address card icon"></i> View Card
      <i class="right chevron icon"></i>
    </a>
  </div>

  <table class="ui very basic unstackable table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($member->users as $key => $user)
      <tr>
        <td>
          <h4 class="ui header">
            <i class="address card icon"></i>
            <div class="content">
              {{ $user->firstname . ' ' . $user->lastname }}
              <div class="sub header">
                {{ $member->type->name }}
                @if ($key != 0)
                  (Dependent)
                @endif
              </div>
            </div>
          </h4>
        </td>
        <td></td>
      </tr>
      @endforeach

    </tbody>
  </table>

  <div class="ui basic modal" id="dependent">
    <div class="ui icon header">
      <i class="address card icon"></i>
      Add Dependent
    </div>
    {!! Form::model($member, ['route' => ['cashier.members.addDependent', $member], 'class' => 'ui form', 'method' => 'PUT']) !!}
    <div class="content">
      <p style="text-align:center">Who do you want to make a dependent for this membership?</p>
      <div class="field">
        {!! Form::select('user_id', $users, null, ['placeholder' => 'Who do you want to turn into a member?', 'class' => 'ui search dropdown']) !!}
      </div>
      <div class="field">
        {!! Form::button('<i class="checkmark icon"></i> Add Dependent', ['type' => 'submit', 'class' => 'ui green ok inverted button']) !!}
      </div>
    </div>
    {!! Form::close() !!}
    <div class="actions">
      <div class="ui red basic cancel inverted button">
        <i class="remove icon"></i>
        Cancel
      </div>
    </div>
  </div>

@endsection
