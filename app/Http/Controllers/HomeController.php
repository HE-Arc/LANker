<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $events = Event::whereDate('date_end','>',date('Y-m-d H:i:s'))->where('public', '1')->orderBy('date_start')->limit(10)->get();
      return view('dashboard', compact('events'));
    }
}
