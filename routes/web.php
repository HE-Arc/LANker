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

Auth::routes();

Route::group(['prefix' => '/'], function() {
  Route::get('', [
    'as' => 'dashboard',
    'uses' => 'HomeController@index'
  ]);

  Route::get('dashboard', [
    'as' => 'dashboard',
    'uses' => 'HomeController@index'
  ]);

  Route::get('home', [
    'as' => 'dashboard',
    'uses' => 'HomeController@index'
  ]);
});

Route::get('/search_event', [
  'as' => 'search_event',
  'uses' => 'EventController@searchEvent'
]);

Route::get('/event/{name}',[
  'as' => 'event',
  'uses' => 'EventController@show'
]);

Route::get('/event/join/{id}',[
  'as' => 'join_event',
  'uses' => 'EventController@joinEvent'
])->middleware('auth');

Route::get('/event/leave/{id}',[
  'as' => 'leave_event',
  'uses' => 'EventController@leaveEvent'
])->middleware('auth');

//TODO: rajouter middleware auth
Route::get('/event/form',[
  'as' => 'form_event',
  'uses' => 'EventController@form'
])->middleware('auth');

Route::post('/event/form/create', [
  'as' => 'create_event',
  'uses' => 'EventController@create'
])->middleware('auth');

// TODO: ajouter vue quand user pas trouvé (plutot que redirect à home)
Route::get('/profile/{name}',[
  'as' => 'profile',
  'uses' => 'UserController@show'
]);

Route::get('/profile/edit/{user}',[
  'as' => 'edit_profile',
  'uses' => 'UserController@edit'
])->middleware('auth');

Route::patch('profile/edit/{user}/update', [
  'as' => 'update_profile',
  'uses' => 'UserController@update'
])->middleware('auth');

Route::delete('profile/delete/{user}', [
  'as' => 'delete_profile',
  'uses' => 'UserController@delete'
])->middleware('auth');

// Debug route to restore all softDeleted users
Route::get('restore', [
  'as' => 'restore_profiles',
  'uses' => 'UserController@restore'
]);

// Debug route to permanently delete all softDeleted users
Route::get('forceDelete', [
  'as' => 'forceDelete_profiles',
  'uses' => 'UserController@forceDelete'
]);

Route::group(['prefix' => 'lanker_admin'], function() {
  Voyager::routes();
});
