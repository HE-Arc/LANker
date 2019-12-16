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
    return $this->belongsToMany('App\User', 'eventusers');
  }

  public function eventgames()
  {
    return $this->hasMany('App\Eventgame');
  }

  /**
  * Return the description with hyperlinks.
  */
  public function getFormatedDescription(){
    return preg_replace('/((http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?)/', '<a href="\1">\1</a>', $this->description);
  }

  /**
  * Return formatted end time.
  */
  public function getEndTime()
  {
    return date("H:i", strtotime($this->date_end));
  }

  /**
  * Return formatted start time.
  */
  public function getStartTime()
  {
    return date("H:i", strtotime($this->date_start));
  }

  /**
  * Return formatted start date.
  */
  public function getStartDate()
  {
    return date("j M Y", strtotime($this->date_start));
  }

  /**
  * Return formatted end date if different from start date. Otherwise returns an empty string.
  */
  public function getEndDate()
  {
    $date=date("j M Y", strtotime($this->date_end));
    if(strcmp($date, $this->getStartDate())==0){
      return "";
    }
    return " - " . $date;
  }

  /**
  * Return formatted price.
  */
  public function getPrice()
  {
    if($this->price==0){
      return "Free";
    }
    return $this->price.".-";
  }

  /**
  * Return formatted number of seats.
  */
  public function getNbSeats(){
    if($this->seats==0){
      return "-";
    }
    return $this->seats;
  }

  public function getId()
  {
    return $this->id;
  }
}
