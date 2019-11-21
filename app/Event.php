<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  /**
   * The users that follow an event.
   */
  public function users()
  {
      return $this->belongsToMany('App\User');
  }
}
