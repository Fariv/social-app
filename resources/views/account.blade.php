@extends('layouts.master_dsahboard')

@section('title')
  Accounts
@endsection

@section('content')

  <section class="row new-post">
    <div class="col-sm-6 col-sm-offset-3">
      <header>
        <h3>Your Account</h3>
      </header>
      <form enctype="multipart/form-data" action="{{ route('account.save') }}" method="post">
        <div class="form-group">
          <label for="fullname">Your Name</label>
          <input type="text" name="fullname" value="{{ $user->fullname }}" id="fullname">
        </div>
        <div class="form-group">
          <label for="image">Image for Profile Photo (Only .jpg format)</label>
          <input type="file" name="image" class="form-control" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Save Account</button>

        {{ csrf_field() }}
      </form>
    </div>
  </section>

  @if(Storage::disk('local')->has($user->email . '-' . $user->id . '.jpg'))
    <section class="row new-post">
      <div class="col-sm-6 col-sm-offset-3">
        <img src="{{ route('account.image', ['filename' => $user->email . '-' . $user->id . '.jpg']) }}" alt="Your Profile Picture" class="img-responsive">
      </div>
    </section>
  @endif
@endsection
