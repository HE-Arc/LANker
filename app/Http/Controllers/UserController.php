<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{

  function __construct()
  {
    // $this->middleware('auth');
  }

  public function edit(User $user)
  {
    return view('edit', compact('user'));
  }

  public function update(User $user)
  {
    $this->validate(request(), [
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8|confirmed'
    ]);

    $user->email = request('email');
    $user->password = bcrypt(request('password'));

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
