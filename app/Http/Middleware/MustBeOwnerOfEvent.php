<?php

namespace App\Http\Middleware;

use Closure;
use App\Event;
use Illuminate\Support\Facades\Log;

class MustBeOwnerOfEvent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      // $id = $this->routes('edit_event');
      //
      // $event = Event::findOrFail($id);
      //
      // if($event->user_id == $this->auth()->id)
      // {
      //   return $next($request);
      // }
      //
      // return redirect()->routes('dashboard');
      Log::info($request);
      return $next($request);
    }
}
