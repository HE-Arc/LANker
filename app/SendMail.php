<?php

namespace App;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$event_name,$url)
    {
        $this->data =['name'=>$username,'event'=>$event_name,'url'=>$url];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('noreply@lanker.com')->subject('Event invitation')->view('dynamic_invite_email_template')->with('data', $this->data);
    }
}
