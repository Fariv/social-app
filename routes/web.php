<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::post('/signup', 'UserController@postSignup');

Route::get('/dashboard', [
  'uses' => 'PostController@getDashboard',
  'as' => 'dashboard',
  'middleware' => 'auth'
]);

Route::post('/signin', 'UserController@postSignin');

Route::post('/create-post', [
  'uses' => 'PostController@store',
  'as' => 'post.create',
  'middleware' => 'auth'
]);

Route::get('/delete-post/{post_id}', [
  'uses' => 'PostController@deletePost',
  'as' => 'post.delete',
  'middleware' => 'auth'
]);

Route::get('/logout', [
  'uses' => 'UserController@userLogout',
  'as' => 'user.logout'
]);

Route::get('/account', [
  'uses' => 'UserController@getAccount',
  'as' => 'account'
]);

Route::get('/userpropic/{filename}', [
  'uses' => 'UserController@getUserProPic',
  'as' => 'account.image'
]);

Route::post('/update-account', [
  'uses' => 'UserController@postSaveAccount',
  'as' => 'account.save'
]);

Route::post('/edit', [
  'uses' => 'PostController@update',
  'as' => 'edit'
]);

Route::post('/like', [
  'uses' => 'PostController@postLikePost',
  'as' => 'like'
]);
