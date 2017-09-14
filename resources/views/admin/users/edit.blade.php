@extends('layout.admin')

@section('title', 'Edit User')

@section('subtitle', $user->firstname.' '.$user->lastname)

@section('icon', 'user')

@section('content')

  {!! Form::model($user, ['route' => ['admin.users.update', $user], 'class' => 'ui form', 'method' => 'PUT']) !!}
  <div class="field">
    <div class="ui buttons">
      <a href="{{ route('admin.users.index') }}" class="ui default button"><i class="left chevron icon"></i> Back</a>
      {!! Form::button('<i class="save icon"></i> Save', ['type' => 'submit', 'class' => 'ui secondary button']) !!}
    </div>
  </div>
  <div class="two fields">
    <div class="field">
      {!! Form::label('firstname', 'First Name') !!}
      {!! Form::text('firstname', null, ['placeholder' => 'First Name']) !!}
    </div>
    <div class="field">
      {!! Form::label('lastname', 'Last Name') !!}
      {!! Form::text('lastname', null, ['placeholder' => 'Last Name']) !!}
    </div>
  </div>
  <div class="two three fields">
    <div class="field">
      {!! Form::label('role_id', 'Role') !!}
      {!! Form::select('role_id', $roles, null, ['class' => 'ui dropdown']) !!}
    </div>
    <div class="field">
      {!! Form::label('organization_id', 'Organization') !!}
      {!! Form::select('organization_id', $organizations, null, ['class' => 'ui dropdown']) !!}
    </div>
    <div class="field">
      {!! Form::label('email', 'Email') !!}
      {!! Form::text('email', null, ['placeholder' => 'Email']) !!}
    </div>
  </div>
  <div class="two fields">
    <div class="field">
      {!! Form::label('password', 'Password') !!}
      {!! Form::password('password', null, ['placeholder' => 'Password']) !!}
    </div>
    <div class="field">
      {!! Form::label('password_confirmation', 'Confirm Password') !!}
      {!! Form::password('password_confirmation', null, ['placeholder' => 'Last Name']) !!}
    </div>
  </div>
  <div class="field">
    <div class="ui buttons">
      <a href="{{ route('admin.users.index') }}" class="ui default button"><i class="left chevron icon"></i> Back</a>
      {!! Form::button('<i class="save icon"></i> Save', ['type' => 'submit', 'class' => 'ui secondary button']) !!}
    </div>
  </div>
  {!! Form::close() !!}



@endsection
