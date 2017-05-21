@extends('layouts.master_dsahboard')

@section('title')

Dashboard

@endsection

@section('content')

<!-- message and alert block -->
@include('includes.message-block')

<!-- template for posting a new post for user -->
<section class="row new-post">
  <div class="col-sm-6 col-sm-offset-3">
    <header>
      <h3>What's in your mind?</h3>
    </header>
    <form action="{{ route('post.create') }}" method="post">
      <div class="form-group">
        <textarea name="body" id="body" rows="5" class="form-control" placeholder="Your Post"></textarea>
      </div>
      <button class="btn btn-primary" type="submit">Create Post</button>
      {{ csrf_field() }}
    </form>
  </div>
</section>

<!-- template for showing posts for the user -->
<section class="row posts">
  <div class="col-sm-6 col-sm-offset-3">
    <header>
      <h3>What other people had in their minds....</h3>
    </header>
    @foreach($posts as $post)

    <article class="post" data-postid="{{ $post->id }}">
      <p>{{ $post->body }}</p>
      <div class="info">
        Posted by {{ $post->user->fullname }} on {{ $post->created_at }}
      </div>
      <div class="interaction">
        <a href="#" class="likeAct">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'LIKED' : 'Like' : 'Like' }}</a> |
        <a href="#" class="likeAct">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'DISLIKED' : 'Dislike' : 'Dislike' }}</a>
        <!-- <span> | {{ DB::table('likes')->where([['like','=','1'], ['post_id', '=', '$post->id']])->count() }}</span> -->
        @if(Auth::user() == $post->user)
          | <a href="#"  class="editpost-dialog-link" data-postid="{{ $post->id }}">Edit</a> |
          <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
        @endif
      </div>
    </article>

    @endforeach
  </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span aria-hiddent="true">&times;</span>
        </button>
        <h4 class="modal-title">Edit The Post</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="post-body"></label>
            <textarea name="post-body" id="post-body" rows="5" class="form-control"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-changes">Save Changes</button>
      </div>
    </div>
  </div>
</div> <!-- end of the modal for editing posts -->

<script type="text/javascript">
  var token = '{{ Session::token() }}';
  var url = '{{ route('edit') }}'
  var urlLike = '{{ route('like') }}'
</script>
@endsection
