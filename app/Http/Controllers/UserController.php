<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
/**
 *
 */
class UserController extends Controller
{
  //
  // function __construct()
  // {
  //   # code...
  // }

  public function postSignup(Request $request)
  {
    // dd(request()->all());

    $this->validate($request, [
      'email' => 'required | email | unique:users',
      'fullname' => 'required | max:120',
      'password' => 'required | min:3'
    ]);

    $email = $request['email'];
    $fullname = $request['fullname'];
    $password = bcrypt($request['password']);

    $user = new User();
    $user->email = $email;
    $user->fullname = $fullname;
    $user->password = $password;

    $user->save();

    Auth::login($user);

    return redirect('/dashboard');
  }
  public function postSignin(Request $request)
  {
    $this->validate($request, [
      'email' => 'required | email',
      'password' => 'required | min:3'
    ]);

    $email = $request['email'];
    $password = $request['password'];
    if(Auth::attempt(['email' => $email, 'password' => $password])){
      return redirect('/dashboard');
    }
    return redirect()->back();
  }
  public function userLogout()
  {
    Auth::logout();
    return redirect()->route('home');
  }

  public function getAccount()
  {
    return view('account')->with(['user' => Auth::user()]);
  }

  public function postSaveAccount(Request $request)
  {
    $this->validate($request, ['fullname' => 'required | max:120']);

    $user = Auth::user();
    $user->fullname = $request['fullname'];

    $user->update();
    $file = $request->file('image');
    $filename = $user->email . '-' . $user->id . '.jpg';
    if ($file) {
      Storage::disk('local')->put($filename, File::get($file));
    }
    return redirect()->route('account');
  }

  public function getUserProPic($filename)
  {
    $file = Storage::disk('local')->get($filename);
    return new Response($file, 200);
  }
}


?>
