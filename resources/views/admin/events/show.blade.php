@extends('layout.admin')

@section('title', 'Event Information')

@section('content')

  <h2 class="ui dividing header">
    <i class="book icon"></i>
    <div class="content">
      Event Information
      <div class="sub header">{{ App\Show::find($event->show_id)->name }}</div>
    </div>
  </h2>

  <div class="ui buttons">
    <a href="{{ route('admin.events.index') }}" class="ui default button">
      <i class="left chevron icon"></i> Back
    </a>
    <a href="{{ route('admin.events.edit', $event) }}" class="ui primary button">
      <i class="edit icon"></i> Edit This Event
    </a>
    <a href="{{ route('admin.events.create') }}" class="ui secondary button">
      <i class="calendar plus icon"></i> Create Another Event
    </a>
    {!! Form::open(['route' => ['admin.events.destroy', $event], 'method' => 'DELETE']) !!}
      {!! Form::button('<i class="trash icon"></i> Delete Event', ['type' => 'submit', 'class' => 'ui negative button']) !!}
    {!! Form::close() !!}
  </div>

  <div class="ui unstackable items">
    <div class="item">
      <div class="image">
        <img src="https://semantic-ui.com/images/wireframe/image.png" alt="">
      </div>
      <div class="content">
        <div class="meta">
          <div class="ui label">{{ $event->type }}</div>
          <div class="ui label">{{ App\Show::find($event->show_id)->type }}</div>
          <div class="ui label">{{ App\Show::find($event->show_id)->duration }} minutes</div>
        </div>
        <h1 class="ui huge header">
          {{ App\Show::find($event->show_id)->name }}
          <div class="sub header">
            <i class="calendar icon"></i>
            {{ Date::parse($event->start)->format('l, F j, Y \a\t g:i A') }}
          </div>
        </h1>
        <div class="meta">
          <span class="ui tag label">$ {{ $event->adults_price }} / adult</span>
          <span class="ui tag label">$ {{ $event->children_price }} / child</span>
          <span class="ui tag label">$ {{ $event->members_price }} / member</span>
        </div>
        <div class="description">
          <p>Created by {{ $event->creator->firstname }} {{ $event->creator->lastname }} on {{ Date::parse($event->created_at)->format('l, F j, Y \a\t g:i:s A') }} ({{ Date::parse($event->created_at)->diffForHumans()}})</p>
          <p>Updated on {{ Date::parse($event->updated_at)->format('l, F j, Y \a\t g:i:s A') }} ({{ Date::parse($event->updated_at)->diffForHumans()}})</p>
        </div>
        <div class="extra">
            <h3>Memo</h3>
            {{ $event->memo }}
        </div>
      </div>
    </div>
  </div>

@endsection
