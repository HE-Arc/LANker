<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $role = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id'        => $role->id,
            ]);
        }

        $role = Role::where('name', 'user')->firstOrFail();
        $usernames=['Bianchi','Bouthillier','Bueche','Capocasale','Carraux','Christe','Claude','Cortes','Freiburghaus','Friche','Jurasz','Kilic','Linder','Minnig','Moulin','Praz','Rubin','Sadiku','Vallat'];
        foreach ($usernames as $username) {
          User::create([
              'name'           => $username,
              'email'          => strtolower($username).'@he-arc.ch',
              'password'       => bcrypt(strtolower($username)),
              'remember_token' => Str::random(60),
              'role_id'        => $role->id,
          ]);
        }

    }
}
