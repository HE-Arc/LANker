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


  public function getFormatedDescription(){
    return preg_replace('/((http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?)/', '<a href="\1">\1</a>', $this->description);
  }

  public function getEndTime()
  {
    return date("H:i", strtotime($this->date_end));
  }

  public function getStartTime()
  {
    return date("H:i", strtotime($this->date_start));
  }

  public function getStartDate()
  {
    //return new DateTime($this->date_start)->format('d-m-Y');
    //return substr($this->date_end,0,10);
    return date("j M Y", strtotime($this->date_start));
  }

  public function getEndDate()
  {
    $date=date("j M Y", strtotime($this->date_end));
    if(strcmp($date, $this->getStartDate())==0){
      return "";
    }
    return " - " . $date;
  }

  public function getPrice()
  {
    if($this->price==0){
      return "Free";
    }
    return $this->price.".-";
  }

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
