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
})->name('dashboard')->middleware('forcessl');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('forcessl');

Route::get('/event', function() {
   return view('event');
})->middleware('forcessl');

// TODO: ajouter vue quand user pas trouvé (plutot que redirect à home)
// TODO: the logic need to be in a controller
// TODO: don't except a name, give the function the user himself as an object
Route::get('/profile/{name}',[
  'as' => 'profile',
  'uses' => 'UserController@show'])->middleware('forcessl');

Route::get('/profile/edit/{user}',[
  'as' => 'edit_profile',
  'uses' => 'UserController@edit'])->middleware('auth', 'forcessl');

Route::patch('profile/edit/{user}/update', [
  'as' => 'update_profile',
  'uses' => 'UserController@update'])->middleware('auth', 'forcessl');

Route::delete('profile/delete/{user}', [
  'as' => 'delete_profile',
  'uses' => 'UserController@delete'])->middleware('auth', 'forcessl');

// Debug route to restore all softDeleted users
Route::get('restore', [
  'as' => 'restore_profiles',
  'uses' => 'UserController@restore']);

// Debug route to permanently delete all softDeleted users
Route::get('forceDelete', [
  'as' => 'forceDelete_profiles',
  'uses' => 'UserController@forceDelete']);
