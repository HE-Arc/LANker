<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EventCreateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {

  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
   public function show(string $name)
   {
     $event = Event::where('name', $name)->first();
     return view('event', compact('event'));
   }

   public function form()
   {
     return view('event_form');
   }

   public function searchEvent(Request $request)
   {
     $name = $request->input('searchvalue') . '%';
     $events = Event::where('name', 'like', $name)->take(10)->get();
     return view('search_event', compact('events'));
   }

   public function joinEvent(int $id)
   {
     $event = Event::find($id);
     $event->users()->attach(Auth::id());
     return redirect()->back();
   }

   public function leaveEvent(int $id)
   {
     $event = Event::find($id);
     $event->users()->detach(Auth::id());
     return redirect()->back();
   }

   public function create(EventCreateRequest $request)
   {
     $validated = $request->validated();

     if(!$validated){
       return redirect()->back()->withInput();
     }

     $event = new Event;
     $event->name = $request->name;
     $combinedDTStart = date('Y-m-d H:i:s', strtotime("$request->date $request->start:00"));
     $combinedDTEnd = date('Y-m-d H:i:s', strtotime("$request->date $request->end:00"));
     $event->date_start = $combinedDTStart;
     $event->date_end = $combinedDTEnd;
     $event->location = $request->location;
     $event->description = $request->description;
     if (isset($request->private)) {
          $event->public = 0;
     }
     $event->user_id = Auth::id();

     if($request->has("image"))
     {
       $image = $request->image->store('public/banners');
       $event->banner = substr($image, strlen("public/"));
     }

     $event->save();

     $games = split(',',$request->games);

     foreach ($games as $game) {
       $eventgame = new Eventgame;
       $eventgame->game = $game;
       $event->eventgames()->save($eventgame);
     }

     return redirect()->route('dashboard');
   }

   public function inviteUsername()
   {

     $event_name=app('request')->input('event_name');
     $username=app('request')->input('username');
     $email = DB::table('users')->where('name',$username)->select('email')->get();
     $validator = Validator::make(['username'=>$email], ['username' => 'required',])->validate(); //Trick to get the good error
     $this->sendMail($email,$event_name);
     return redirect()->route('event', ['name' => $event_name]);
   }

   public function invite()
   {
     $event_name=app('request')->input('event_name');
     $email=app('request')->input('email');
     $validator = Validator::make(['email'=>$email], ['email' => 'required|email',])->validate();
     $this->sendMail($email,$event_name);
     return redirect()->route('event', ['name' => $event_name]);
   }

   private function sendMail($email, $event_name)
   {
     $url = str_replace("http://","",URL::route('event', ['name'=>$event_name]));
     Mail::to($email)->send(new SendMail(Auth::user()->name,$event_name,$url));
   }

   public function showInvite(Event $event)
   {
     return view('invite_form', ['event' => $event]);
   }
}
