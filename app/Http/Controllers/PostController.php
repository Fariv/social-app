<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getDashboard()
    {
      $posts = Post::orderBy('created_at', 'desc')->get();
      return view('dashboard')->with(['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'body' => 'required | max:1000 | min:3'
      ]);

      $post = new Post();
      $post->body = $request['body'];
      $message = "There is something errors!";
      if($request->user()->posts()->save($post)){
        $message = "The Post is successfully Published!";
      }
      return redirect()->route('dashboard')->with(['message' => $message]);
    }

    public function deletePost($post_id)
    {
      $post = Post::where('id', $post_id)->first();
      if (Auth::user() != $post->user) {
        return redirect()->back();
      }

      $post->delete();
      return redirect()->route('dashboard')->with(['message' => 'Successfully deleted!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $this->validate($request, ['body' => 'required']);

      $post = Post::find($request['postId']);
      $post->body = $request['body'];
      $post->update();

      return response()->json(['new_body' => $post->body], 200);
    }

    public function postLikePost(Request $request)
    {
      $post_id = $request['postId'];
      $is_like = $request['isLike'] === 'true' ? true: false;
      $update = false;

      $post = Post::find($post_id);
      if (! $post) {
        return null;
      }

      $user = Auth::user();
      $like = $user->likes()->where('post_id', $post_id)->first();
      if($like){
        $already_like = $like->like;
        $update = true;
        if($already_like == $is_like){
          $like->delete();
          return null;
        }
      }else {
        $like = new Like();
      }

      $like->like = $is_like;
      $like->user_id = $user->id;
      $like->post_id = $post->id;

      if ($update) {
        $like->update();
      } else {
        $like->save();
      }


      return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
