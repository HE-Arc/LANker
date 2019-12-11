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

  public function getFormatedDescription(){
    return preg_replace('/((http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?)/', '<a href="\1">\1</a>', $this->description);
  }
}
