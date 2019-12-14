<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\Cover;
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
    public function findGames()
    {
        $name="";
        if(isset($_GET['name'])){$name=$_GET['name'];}
        $games=Game::limit(10)->where('name','ilike',$name."%")->orderBy('name')->select('name')->with(['cover'])->get();
        echo json_encode($games);
    }
}
