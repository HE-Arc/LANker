<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserEditRequest;
use App\Event;
use App\Eventuser;
use App\Usergame;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

  function __construct()
  {
    // $this->middleware('auth');
  }

  public function edit(User $user)
  {
    $user = Auth::user();
    return view('edit', compact('user'));
  }

  public function update(UserEditRequest $request)
  {
    $user = Auth::user();

    if(!$request->validated()) {
      return redirect()->back()->withInput();
    }

    if(strcmp($request->email, $user->email) != 0)
    {
      $user->email = $request->email;
    }

    if($request->password != "")
    {
      $user->password = bcrypt($request->password);
    }

    if(strcmp($request->description, $user->description) != 0)
    {
      $user->description = $request->description;
    }

    if(isset($request->image))
    {
      if($user->avatar != "users/default.png") {
        Storage::delete("public/".$user->avatar);
      }

      $image = $request->image->store('public/users');

      $user->avatar = substr($image, strlen("public/"));
    }

    if(isset($request->games) && isset($request->covers))
    {
      $games = explode(',',$request->games);
      $covers = explode(',',$request->covers);
      for ($i=0; $i < count($games); $i++) {
        $usergame = new Usergame;
        $usergame->game = $games[$i];
        $usergame->cover = $covers[$i];
        if(!Usergame::where(['user_id' => $user->id, 'game' => $usergame->game])->exists())
        {
          $user->usergames()->save($usergame);
        }
      }
    }

    $user->save();

    return redirect()->route('profile', $user->name);
  }

  public function delete(User $user)
  {
    $user->delete();

    return redirect()->route('dashboard');
  }

  public function restore()
  {
    $users = User::withTrashed()->get();
    foreach ($users as $user) {
      $user->restore();
    }

    return redirect()->route('dashboard');
  }

  /**
   * Remove favorite game from profile.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function removeGame(Usergame $usergame)
  {
    $usergame->delete();

    return redirect()->back();
  }

  public function forceDelete()
  {
    $users = User::withTrashed()->get();
    foreach ($users as $user) {
      if($user->trashed()) {
        if($user->avatar != "users/default.png") {
          Storage::delete("public/".$user->avatar);
        }

        $user->forceDelete();
      }
    }

    return redirect()->route('dashboard');
  }

  public function show(string $name)
  {
    $user = User::where('name',$name)->first();
    if ($user === null) {
      return redirect()->route('dashboard');
    }
    $participated = Eventuser::where('user_id',$user->id)->count();
    $organised = Event::where('user_id',$user->id)->count();

    $participating_evt = Event::join('eventusers', 'events.id', '=', 'eventusers.event_id')->whereDate('date_end','>',date('Y-m-d H:i:s'))->where('eventusers.user_id',$user->id)->get();
    $participated_evt = Event::join('eventusers', 'events.id', '=', 'eventusers.event_id')->whereDate('date_end','<',date('Y-m-d H:i:s'))->where('eventusers.user_id',$user->id)->get();

    $organising_evt = Event::whereDate('date_end','>',date('Y-m-d H:i:s'))->where('user_id',$user->id)->get();
    $organised_evt = Event::whereDate('date_end','<',date('Y-m-d H:i:s'))->where('user_id',$user->id)->get();

    return view('profile', ['user' => $user, 'participated'=>$participated,'organised'=>$organised, 'participating_evt'=>$participating_evt,'organising_evt'=>$organising_evt, 'participated_evt'=>$participated_evt,'organised_evt'=>$organised_evt]);
  }

  /**
   * Show the event creation form.
   *
   * @return JSON array containing matching users
   */
  public function usernameAutocomplete()
  {
    $name="";
    if(isset($_GET['name'])){$name=$_GET['name'];}
    $users = User::where('name','like',$name."%")->limit(10)->get();
    echo json_encode($users);
  }
}
