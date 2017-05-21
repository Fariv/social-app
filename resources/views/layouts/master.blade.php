<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield("title")</title>
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::to('css/main.css') }}">
  </head>
  <body>
    @include("includes.header")
    <div class="container">
      @yield("content")
    </div>
  </body>
  <script src="{{ URL::to('js/jquery-2.2.4.min.js') }}"></script>
  <script src="{{ URL::to('js/bootstrap.js') }}"></script>
  <script src="{{ URL::to('js/main.js') }}" charset="utf-8"></script>
</html>
