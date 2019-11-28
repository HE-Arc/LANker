<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Game;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
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
    public function find_games()
    {
        $name="";
        if(isset($_GET['name'])){$name=$_GET['name'];}
        $games=Game::limit(10)->where('name','ilike',$name."%")->orderBy('name')->select('name')->get();
        echo json_encode($games);
    }
}
