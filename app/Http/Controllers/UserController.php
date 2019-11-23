<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use Illuminate\Support\Facades\Storage;

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

  public function update(User $user)
  {
    $this->validate(request(), [
      'email' => 'required|email',
      'password' => 'confirmed',
      'description' => 'max:2048'
    ]);

    if(strcmp(request('email'), $user->email) != 0)
    {
      $user->email = request('email');
    }

    if(request('password') != "")
    {
      $user->password = bcrypt(request('password'));
    }

    if(strcmp(request('description'), $user->description) != 0)
    {
      $user->description = request('description');
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

    Storage::delete("public/".$user->avatar);

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
    return view('profile', ['user' => $user]);
  }
}
