<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventuser extends Model
{
    public function events()
    {
      return $this->belongsTo('App\User');
    }
}
