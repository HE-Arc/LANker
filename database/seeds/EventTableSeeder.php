<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'name' => 'Tournoi FIFA 20 2vs2',
            'location' => 'Rue du Théâtre 9, 1820 Montreux',
            'description' => "Ton ami et toi êtes imbattable à FIFA ? Venez défier les plus grands joueurs de le région au Tournoi FIFA 20
                              organisé par le FC Sion dans les salons du Casino Barrière Montreux ! <br> https://www.gameturnier.ch/b2h_fifa20_91t",
            'date_start' => date('Y-m-d H:i:s', strtotime("2019-12-21 10:00:00")),
            'date_end' => date('Y-m-d H:i:s', strtotime("2019-12-21 19:00:00")),
            'public' => 1,
            'banner' => "banners/fifa.jpg",
            'price' => 70.0,
            'user_id' => 4,
        ]);

    }
}
