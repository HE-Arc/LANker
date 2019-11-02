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
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/event', function() {
   return view('event');
});

// TODO: change to user profile when users are implemented
// TODO: ajouter vue quand user pas trouvé (plutot que redirect à home)
Route::get('/profile/{name}', function($name) {
  $user = User::where('name',$name)->first();
  if ($user === null) {
   return redirect('/');
  }
  return view('profile', ['user' => $user]);
});

Route::delete('/users/{id}', function($id) {
  User::findOrFail($id)->delete();
  return redirect('/');
});

// Debug route to restore all softDeleted users
Route::get('/restore', function() {
  $users = User::withTrashed()->get();
  foreach ($users as $user) {
    $user->restore();
  }
  return redirect('/');
});

// Debug route to permanently delete all softDeleted users
Route::get('/forceDelete', function() {
  $users = User::withTrashed()->get();
  foreach ($users as $user) {
    if($user->trashed()) {
      $user->forceDelete();
    }
  }
  return redirect('/');
});
