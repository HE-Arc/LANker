<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventgame extends Model
{
    public function events()
    {
      return $this->belongsTo('App\Event');
    }
}
