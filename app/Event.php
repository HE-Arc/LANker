<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  /**
   * The users that follow an event.
   */
  public function roles()
  {
      return $this->belongsToMany('App\User');
  }
}
