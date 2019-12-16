<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Eventgame;
use App\Eventuser;
use App\SendMail;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventEditRequest;
use App\Http\Requests\InviteEmailRequest;
use App\Http\Requests\InviteUsernameRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

   public function edit(int $id)
   {
     $event = Event::where('id', $id)->first();
     return view('event_edit', compact('event'));
   }

   public function searchEvent(Request $request)
   {
     $name = $request->input('searchvalue') . '%';
     $events = Event::where('name', 'like', $name)->where('public', '1')->take(10)->get();
     $users =  User::where('name', 'like', $name)->take(10)->get();

     return view('search_event', compact('events', 'users'));
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

     if(!$validated)
     {
       return redirect()->back()->withInput();
     }

     $event = new Event;
     $event->name = $request->event_name;
     $event->host = $request->host_name;
     $combinedDTStart = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time:00"));
     $combinedDTEnd = date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time:00"));
     $event->date_start = $combinedDTStart;
     $event->date_end = $combinedDTEnd;
     $event->location = $request->location;
     $event->description = htmlspecialchars($request->description);

     if (isset($request->private))
     {
          $event->public = 0;
     }

     if (isset($request->price)) {
          $event->price = $request->price;
     }

     if(isset($request->seats))
     {
       $event->seats = $request->seats;
     }

     $event->user_id = Auth::id();

     if(isset($request->image))
     {
       $image = $request->image->store('public/banners');
       $event->banner = substr($image, strlen("public/"));
     }

     $event->save();

     if(isset($request->games))
     {
       $games = explode(',',$request->games);
       $covers = explode(',',$request->covers);
       for ($i=0; $i < count($games); $i++) {
         $eventgame = new Eventgame;
         $eventgame->game = $games[$i];
         $eventgame->cover=$covers[$i];
         $event->eventgames()->save($eventgame);
       }
     }

     return redirect()->route('event', $event->name);
   }

   public function inviteUsername(InviteUsernameRequest $request)
   {
     $event_name=$request->event_name;
     $username=$request->username;
     $request->validated();
     $email = User::where('name',$username)->select('email')->get();
     $this->sendMail($email,$event_name);
     return redirect()->route('event', ['name' => $event_name]);
   }

   public function invite(InviteEmailRequest $request)
   {
     $event_name=$request->event_name;
     $email=$request->email;
     $request->validated();
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

   public function update(Event $event, EventEditRequest $request)
   {
     if(!$request->validated()) {
       return redirect()->back()->withInput();
     }

     if(strcmp($request->event_name, $event->name) != 0)
     {
       if(Event::where('name', $request->event_name)->where('id', '<>',$event->id)->exists())
       {
         return redirect()->back()->withInput()->withErrors(['event_name' => 'This event name is already taken!']);
       }
       else
       {
         $event->name = $request->event_name;
       }
     }

     if(strcmp($request->host_name, $event->host) != 0)
     {
       $event->host = $request->host_name;
     }

     if(isset($request->image))
     {
       if($event->banner != "banners/dreamhack.jpg")
       {
         Storage::delete("public/" . $event->banner);
       }

       $image = $request->image->store('public/banners');

       $event->banner = substr($image, strlen("public/"));
     }

     if(strcmp($request->location, $event->location) != 0)
     {
       $event->location = $request->location;
     }

     if(isset($request->start_date) && isset($request->end_date) && isset($request->start_time) && isset($request->end_time))
     {
       $combinedDTStart = date('Y-m-d H:i:s', strtotime("$request->start_date $request->start_time:00"));
       $combinedDTEnd = date('Y-m-d H:i:s', strtotime("$request->end_date $request->end_time:00"));
       $event->date_start = $combinedDTStart;
       $event->date_end = $combinedDTEnd;
     }

     if(strcmp($request->description, $event->description) != 0)
     {
       $event->description = htmlspecialchars($request->description);
     }

     if(strcmp($request->price, $event->price) != 0)
     {
       $event->price = $request->price;
     }

     if(strcmp($request->seats, $event->seats) != 0)
     {
       $event->seats = $request->seats;
     }

     if(isset($request->private))
     {
       $event->public = 0;
     }
     else
     {
       $event->public = 1;
     }

     $event->save();

     return redirect()->route('event', $event->name);
   }

   public function delete(Event $event)
   {
     if($event->banner != "banners/dreamhack.jpg") {
       Storage::delete("public/".$event->banner);
     }

     $event->delete();

     return redirect()->route('dashboard');
   }
}
