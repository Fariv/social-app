@extends('layouts.master')

@section('title')

Welcome!

@endsection

@section('content')

<div class="row">
  <div class="col-md-6">
    <h3>Sign Up</h3>
    <form action="/signup" method="post">

      {{ csrf_field() }}

      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <label for="email">Your E-mail</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ Request::old('email') }}">
      </div>
      <div class="form-group {{ $errors->has('fullname') ? 'has-error' : '' }}">
        <label for="fullname">Name</label>
        <input type="text" name="fullname" id="fullname" class="form-control" value="{{ Request::old('fullname') }}">
      </div>
      <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" value="{{ Request::old('password') }}">
      </div>
      <button type="submit" id="signup" class="btn btn-primary">Sign Up</button>
    </form>
  </div>
  <div class="col-md-6">
    <h3>Sign In</h3>
    <form action="/signin" method="post">

      {{ csrf_field() }}

      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <label for="email">Your E-mail</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ Request::old('email') }}">
      </div>

      <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" value="{{ Request::old('password') }}">
      </div>

      <button type="submit" id="signin" class="btn btn-primary">Sign In</button>
    </form>
  </div>
</div>

@include('includes.message-block')

@endsection
