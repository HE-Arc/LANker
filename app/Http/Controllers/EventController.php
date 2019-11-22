<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Http\Requests\EventCreateRequest;

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
  public function show()
  {
    return view('event');
  }

  public function form()
  {
    return view('event_form');
  }

  public function create(EventCreateRequest $request)
  {
    $validated = $request->validated();

    if(!$validated) {
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
    $event->save();

    return redirect()->route('dashboard');
  }
}
