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
        for ($i=0; $i < 20; $i++) {
          $event_id = Event::select('id')->inRandomOrder()->first();
          $user_id = User::select('id')->inRandomOrder()->first();
          Eventuser::create(['event_id'=>$event_id['id'],'user_id'=>$user_id['id']]);
        }
    }
}
