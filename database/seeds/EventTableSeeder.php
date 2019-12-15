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
      $events = [
        [
          'name' => 'Tournoi FIFA 20 2vs2',
          'location' => 'Rue du Théâtre 9, 1820 Montreux',
          'description' => "Ton ami et toi êtes imbattable à FIFA ? Venez défier les plus grands joueurs de le région au Tournoi FIFA 20
                            organisé par le FC Sion dans les salons du Casino Barrière Montreux ! \n https://www.gameturnier.ch/b2h_fifa20_91t",
          'date_start' => date('Y-m-d H:i:s', strtotime("2019-12-21 10:00:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2019-12-21 19:00:00")),
          'public' => 1,
          'banner' => "banners/fifa.jpg",
          'price' => 70.0,
          'seats' => 0,
          'user_id' => 1,
        ],
        [
          'name' => 'NetGame Convention 2019',
          'location' => 'Badstrasse 2, 4552 Derendingen',
          'description' => "The legendary swiss LANparty event since 1995 \n http://netgame.ch",
          'date_start' => date('Y-m-d H:i:s', strtotime("2019-12-19 18:00:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2019-12-22 16:00:00")),
          'public' => 1,
          'banner' => "banners/netgame.jpg",
          'price' => 49.0,
          'seats' => 250,
          'user_id' => 1,
        ],
        [
          'name' => 'GameTurnier',
          'location' => 'Schulhausstrasse 22, Fehraltorf',
          'description' => "Vor 10 Jahren fand im Heiget Huus unser erstes FIFA Turnier statt. Im Januar 2020 heisst es nach langer Zeit wieder – back 2 Heiget Huus. Na, seid ihr auch mit dabei?
                            Nebst FIFA 20 gibt’s auch ein Call of Duty Turnier an diesem Wochenende.\nSamstag: 2v2 Call of Duty Gunfight \nSonntag: 2v2 FIFA 20 Turnier
                            https://www.gameturnier.ch/b2h_callofduty_92t",
          'date_start' => date('Y-m-d H:i:s', strtotime("2020-01-11 11:30:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2020-01-12 17:30:00")),
          'public' => 1,
          'banner' => "banners/gameturnier.png",
          'price' => 50.0,
          'seats' => 0,
          'user_id' => 1,
        ],
        [
          'name' => 'Lock and Load 12',
          'location' => 'St. Urban-Strasse 5, 6210 Sursee',
          'description' => "Nach der äusserst erfolgreichen LAL11 kommen wir auch im 2020 zurück nach Sursee – kompetitiv und dennoch gemütlich wie eh und je!
                            Vom 24.04.20 – 26.04.20 erwartet dich und 511 andere Zocker ein Wochenende voller ESPORTS und GAMING in der Stadthalle Sursee am grössten ESPORTS Event der Zentralschweiz.
                            Wir freuen uns auch 2020 für euch wieder einen tollen Event zu organisieren und freuen und jetzt schon auf zahlreiche Anmeldungen für die #LAL12!
                            https://lockandload.ch",
          'date_start' => date('Y-m-d H:i:s', strtotime("2020-04-24 14:00:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2020-04-26 14:00:00")),
          'public' => 1,
          'banner' => "banners/dreamhack.jpg",
          'price' => 75.0,
          'seats' => 512,
          'user_id' => 1,
        ],
        [
          'name' => 'Dreamhack',
          'location' => 'Leipziger Messe, Germany',
          'description' => "DreamHack Leipzig is a three-day gaming festival where you can enjoy professional eSports tournaments.
                            It is where one discovers the latest hardware and software at DreamExpo and at the DreamStore.
                            It also throws Germany's biggest LAN party with Cosplay, Casemodding and game scene influencers.
                            https://www.dreamhack-leipzig.de/en/",
          'date_start' => date('Y-m-d H:i:s', strtotime("2020-01-24 10:00:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2020-01-26 18:00:00")),
          'public' => 1,
          'banner' => "banners/dreamhack_logo.png",
          'price' => 60.0,
          'seats' => 20000,
          'user_id' => 1,
        ],
        [
          'name' => 'Paris Games Week',
          'location' => '1 Place de la Porte de Versailles, 75015 Paris',
          'description' => "Pour sa 10ème édition consécutive, l’événement a célébré la Pop-Culture sous toutes ses formes. Constructeurs, éditeurs, studios et accessoiristes se sont réunis pour
                            présenter les nouveautés de fin d’année, les jeux 2020 en avant-première, les innovations technologiques comme les nouvelles consoles et la réalité virtuelle,
                            et les compétitions Esport.
                            https://www.dreamhack-leipzig.de/en/",
          'date_start' => date('Y-m-d H:i:s', strtotime("2020-10-23 09:00:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2020-10-27 21:00:00")),
          'public' => 1,
          'banner' => "banners/pgw.jpg",
          'price' => 100.0,
          'seats' => 320000,
          'user_id' => 1,
        ],
        [
          'name' => 'Insomnia',
          'location' => 'North Ave, Birmingham B40 1NT ',
          'description' => "Insomnia returns to the NEC, Birmingham on 10th-13th April for its biggest show yet.
                            See your favourite YouTubers from across the globe, play some of the latest games, experience virtual reality, relive the past in our retro zone, and try a new level of gaming in the tabletop zone and so much more all under one roof!
                            https://insomniagamingfestival.com/",
          'date_start' => date('Y-m-d H:i:s', strtotime("2020-05-10 10:30:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2020-05-13 21:00:00")),
          'public' => 1,
          'banner' => "banners/insomnia.png",
          'price' => 100.0,
          'seats' => 25000,
          'user_id' => 1,
        ],
        [
          'name' => 'Tournoi FIFA 19 2vs2',
          'location' => 'Rue du Théâtre 9, 1820 Montreux',
          'description' => "Ton ami et toi êtes imbattable à FIFA ? Venez défier les plus grands joueurs de le région au Tournoi FIFA 20
                            organisé par le FC Sion dans les salons du Casino Barrière Montreux ! \n https://www.gameturnier.ch/b2h_fifa20_91t",
          'date_start' => date('Y-m-d H:i:s', strtotime("2018-12-21 10:00:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2018-12-21 19:00:00")),
          'public' => 1,
          'banner' => "banners/fifa.jpg",
          'price' => 70.0,
          'seats' => 0,
          'user_id' => 1,
        ],
        [
          'name' => 'NetGame Convention 2018',
          'location' => 'Badstrasse 2, 4552 Derendingen',
          'description' => "The legendary swiss LANparty event since 1995 \n http://netgame.ch",
          'date_start' => date('Y-m-d H:i:s', strtotime("2018-12-19 18:00:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2018-12-22 16:00:00")),
          'public' => 1,
          'banner' => "banners/netgame.jpg",
          'price' => 49.0,
          'seats' => 250,
          'user_id' => 1,
        ],
        [
          'name' => 'GameTurnier',
          'location' => 'Schulhausstrasse 22, Fehraltorf',
          'description' => "Vor 10 Jahren fand im Heiget Huus unser erstes FIFA Turnier statt. Im Januar 2019 heisst es nach langer Zeit wieder – back 2 Heiget Huus. Na, seid ihr auch mit dabei?
                            Nebst FIFA 20 gibt’s auch ein Call of Duty Turnier an diesem Wochenende.\nSamstag: 2v2 Call of Duty Gunfight \nSonntag: 2v2 FIFA 20 Turnier
                            https://www.gameturnier.ch/b2h_callofduty_92t",
          'date_start' => date('Y-m-d H:i:s', strtotime("2019-01-11 11:30:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2019-01-12 17:30:00")),
          'public' => 1,
          'banner' => "banners/gameturnier.png",
          'price' => 50.0,
          'seats' => 0,
          'user_id' => 1,
        ],
        [
          'name' => 'Lock and Load 11',
          'location' => 'St. Urban-Strasse 5, 6210 Sursee',
          'description' => "Nach der äusserst erfolgreichen LAL11 kommen wir auch im 2019 zurück nach Sursee – kompetitiv und dennoch gemütlich wie eh und je!
                            Vom 24.04.19 – 26.04.19 erwartet dich und 511 andere Zocker ein Wochenende voller ESPORTS und GAMING in der Stadthalle Sursee am grössten ESPORTS Event der Zentralschweiz.
                            Wir freuen uns auch 2019 für euch wieder einen tollen Event zu organisieren und freuen und jetzt schon auf zahlreiche Anmeldungen für die #LAL11!
                            https://lockandload.ch",
          'date_start' => date('Y-m-d H:i:s', strtotime("2019-04-24 14:00:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2019-04-26 14:00:00")),
          'public' => 1,
          'banner' => "banners/dreamhack.jpg",
          'price' => 75.0,
          'seats' => 512,
          'user_id' => 1,
        ],
        [
          'name' => 'Dreamhack',
          'location' => 'Leipziger Messe, Germany',
          'description' => "DreamHack Leipzig is a three-day gaming festival where you can enjoy professional eSports tournaments.
                            It is where one discovers the latest hardware and software at DreamExpo and at the DreamStore.
                            It also throws Germany's biggest LAN party with Cosplay, Casemodding and game scene influencers.
                            https://www.dreamhack-leipzig.de/en/",
          'date_start' => date('Y-m-d H:i:s', strtotime("2019-01-24 10:00:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2019-01-26 18:00:00")),
          'public' => 1,
          'banner' => "banners/dreamhack_logo.png",
          'price' => 60.0,
          'seats' => 20000,
          'user_id' => 1,
        ],
        [
          'name' => 'Paris Games Week',
          'location' => '1 Place de la Porte de Versailles, 75015 Paris',
          'description' => "Pour sa 9ème édition consécutive, l’événement a célébré la Pop-Culture sous toutes ses formes. Constructeurs, éditeurs, studios et accessoiristes se sont réunis pour
                            présenter les nouveautés de fin d’année, les jeux 2020 en avant-première, les innovations technologiques comme les nouvelles consoles et la réalité virtuelle,
                            et les compétitions Esport.
                            https://www.dreamhack-leipzig.de/en/",
          'date_start' => date('Y-m-d H:i:s', strtotime("2019-10-23 09:00:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2019-10-27 21:00:00")),
          'public' => 1,
          'banner' => "banners/pgw.jpg",
          'price' => 100.0,
          'seats' => 320000,
          'user_id' => 1,
        ],
        [
          'name' => 'Insomnia',
          'location' => 'North Ave, Birmingham B40 1NT ',
          'description' => "Insomnia returns to the NEC, Birmingham on 10th-13th April for its biggest show yet.
                            See your favourite YouTubers from across the globe, play some of the latest games, experience virtual reality, relive the past in our retro zone, and try a new level of gaming in the tabletop zone and so much more all under one roof!
                            https://insomniagamingfestival.com/",
          'date_start' => date('Y-m-d H:i:s', strtotime("2019-05-10 10:30:00")),
          'date_end' => date('Y-m-d H:i:s', strtotime("2019-05-13 21:00:00")),
          'public' => 1,
          'banner' => "banners/insomnia.png",
          'price' => 100.0,
          'seats' => 25000,
          'user_id' => 1,
        ],
      ];

        foreach ($events as $event) {
          Event::create($event);
        }

    }
}
