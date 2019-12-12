<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserEditRequest;
use App\Event;

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
    $validated = $request->validated();

    if(!$validated) {
      return redirect()->back()->withInput();
    }

    if(strcmp($request->input('email'), $user->email) != 0)
    {
      $user->email = $request->input('email');
    }

    if($request->input('password') != "")
    {
      $user->password = bcrypt($request->input('password'));
    }

    if(strcmp($request->input('description'), $user->description) != 0)
    {
      $user->description = $request->input('description');
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

  public function changeAvatar(User $user)
  {

    $validator = Validator::make(request()->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator);
    }

    if($user->avatar != "users/default.png") {
      Storage::delete("public/".$user->avatar);
    }

    $image = request()->image->store('public/users');

    $user->avatar = substr($image, strlen("public/"));

    $user->save();

    return redirect()->back();
  }

  public function forceDelete()
  {
    $users = User::withTrashed()->get();
    foreach ($users as $user) {
      if($user->trashed()) {
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
    $participated = DB::table('events')->whereDate('date_start','<',date('Y-m-d H:i:s'))->where('user_id',$user->id)->count();
    $organised = DB::table('events')->whereDate('date_start','<',date('Y-m-d H:i:s'))->where('user_id',$user->id)->count();

    $participating_evt = Event::join('eventusers', 'events.id', '=', 'eventusers.event_id')->whereDate('date_start','>',date('Y-m-d H:i:s'))->where('eventusers.user_id',$user->id)->get();
    $participated_evt = Event::join('eventusers', 'events.id', '=', 'eventusers.event_id')->whereDate('date_start','<',date('Y-m-d H:i:s'))->where('eventusers.user_id',$user->id)->get();

    $organising_evt = Event::whereDate('date_start','>',date('Y-m-d H:i:s'))->where('user_id',$user->id)->get();
    $organised_evt = Event::whereDate('date_start','<',date('Y-m-d H:i:s'))->where('user_id',$user->id)->get();

    return view('profile', ['user' => $user, 'participated'=>$participated,'organised'=>$organised, 'participating_evt'=>$participating_evt,'organising_evt'=>$organising_evt, 'participated_evt'=>$participated_evt,'organised_evt'=>$organised_evt]);
  }
}
