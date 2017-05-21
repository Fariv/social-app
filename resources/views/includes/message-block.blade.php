@if(count($errors) > 0)
  <div class="row">
    <div class="col-sm-4 col-sm-offset-4 error">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
@endif

@if(Session::has('message'))
  <div class="row">
    <div class="col-sm-4 col-sm-offset-4 success">
      {{ Session::get('message') }}
    </div>
  </div>
@endif
