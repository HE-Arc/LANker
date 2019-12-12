<?php

use Illuminate\Database\Seeder;
use App\Event;
use App\User;
use App\Eventuser;

class EventUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nb_insert=0;
        while ($nb_insert < 30) {
          $event_id = Event::select('id')->inRandomOrder()->first(); //get random event id
          $user_id = User::select('id')->inRandomOrder()->first(); //get random user id
          $event_id=$event_id['id'];
          $user_id=$user_id['id'];
          if(Eventuser::where('event_id',$event_id)->where('user_id',$user_id)->count()==0){ //if not already in database, insert it
            Eventuser::create(['event_id'=>$event_id,'user_id'=>$user_id]);
            $nb_insert++;
          }
        }
    }
}
