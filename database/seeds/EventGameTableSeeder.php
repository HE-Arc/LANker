<?php

use Illuminate\Database\Seeder;
use App\Event;
use App\Eventgame;


class EventGameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $evt_games= [
        "NetGame Convention 2019" => ['Counter-Strike: Global Offensive','League of Legends','Overwatch','Hearthstone',"PLAYERUNKNOWN'S BATTLEGROUNDS"],
        'Tournoi FIFA 20 2vs2' => ['FIFA 20'],
        'GameTurnier 2020' => ['FIFA 20','Call Of Duty: Modern Warfare'],
        'Lock and Load 12' => ['Counter-Strike: Global Offensive','League of Legends','Overwatch','Hearthstone',"Fortnite"],
        'Dreamhack 2020' => ["Farming Simulator 19",'League of Legends',"Super Smash Bros. Ultimate"],
        'Paris Games Week 2020' => ["NBA 2K20", "Borderlands 3", "Just Dance 2020", "Tom Clancy's Rainbow Six: Siege","Brawlhalla","Mario + Rabbids Kingdom Battle"],
        'Insomnia 2020' => ["Mortal Kombat 11","Rocket League",'Overwatch','League of Legends','FIFA 20'],
      ];
      foreach ($evt_games as $event_name => $games) {
        $event = Event::where('name',$event_name)->first();
        foreach ($games as $game) {
          $params = ['game'=>$game,'event_id'=>$event->getId()];
          Eventgame::create($params);
        }
      }
    }
}
