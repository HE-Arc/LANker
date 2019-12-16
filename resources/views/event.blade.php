@extends('layouts.app')

@section('content')
  <div class="container my-5">
    <img class="event-banner" src="{{ url('storage/'.$event->banner) }}">
    <h1 class="my-4 text-break">{{ $event->name }}</h1>
    <div class="row">
      <div class="col-lg">
        <table class="table">
          <tr>
            <td><i class="fa fa-building p-2 fa-lg mr-3"></i></td>
            <td><p class="lead text-right">{{ $event->host }}</p></td>
          </tr>
          <tr>
            <td><i class="fa fa-dollar-sign p-2 fa-lg mr-3"></i></td>
            <td><p class="lead text-right">{{ $event->getPrice() }}</p></td>
          </tr>
          <tr>
            <td><i class="far fa-clock p-2 fa-lg mr-3"></i></td>
            <td><p class="lead text-right">{{ $event->getStartTime().' - '.$event->getEndTime() }}</p></td>
          </tr>
        </table>
      </div>
      <div class="col-lg">
        <table class="table">
          <tr>
            <td><i class="fa fa-map-marker-alt p-2 fa-lg mr-3"></i></td>
            <td><p class="lead text-right">{{$event->location}}</p></td>
          </tr>
          <tr>
            <td><i class="fa fa-calendar-alt p-2 fa-lg mr-3"></i></td>
            <td><p class="lead text-right">{{ $event->getStartDate().$event->getEndDate() }}</p></td>
          </tr>
          <tr>
            <td><i class="fas fa-chair p-2 fa-lg mr-3"></i></td>
            <td><p class="lead text-right">{{ $event->getNbSeats() }}</p></td>
          </tr>
        </table>
      </div>
    </div>
    @auth
      @if ($event->users()->where('event_id', $event->id)->where('user_id', Auth::user()->id)->exists())
        <a href="{{ route('leave_event', $event->id) }}" class="btn btn-primary my-2">Leave event <i class="fas fa-sign-out-alt"></i></a>
      @else
        <a href="{{ route('join_event', $event->id) }}" class="btn btn-primary my-2">Join event <i class="fas fa-sign-in-alt"></i></a>
      @endif
      <a href="{{ route('invite_event', $event) }}" class="btn btn-primary my-2">Share <i class="fas fa-share"></i></a>
      @if (Auth::user()->id == $event->user_id or Auth::user()->hasRole('admin'))
      <a href="{{ route('edit_event', $event->id) }}" class="btn btn-primary my-2">Modify event <i class="far fa-edit"></i></a>
      <form class="lanker-inline-form" action="{{ route('delete_event', $event) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="submit" class="btn btn-danger my-2" value="Delete event" onclick="return confirm('Are you sure?')"/>
      </form>
      @endif
    @else
      <a href="{{ route('login') }}" class="btn btn-primary">Login first</a>
    @endauth
    <h3 class="my-4">Description</h3>
    <p class="lead lanker-formatted text-break">{!! $event->getFormatedDescription() !!}</p>
    <h3 class="my-4">Games</h3>
    <div class="row">
      @forelse ($event->eventgames()->get() as $eventgame)
        @game_card(['cover'=>$eventgame->cover,'title'=>$eventgame->game])@endgame_card
      @empty
        <div class="col">
          <p class="lead">There doesn't seem to be any games in this event.</p>
        </div>
      @endforelse
    </div>
    <h3 class="my-4">Participants ({{ $event->users()->count() }})</h3>
    <div class="row">
      @forelse($event->users()->get() as $user)
        <div class="col-lg-2 col-sm-6">
          <img src="{{ url('storage/'.$user->avatar) }}" class="mx-auto d-block lanker-sq-img-container-sm rounded-circle" alt="user avatar">
          <p class="lead text-center my-2">{{ $user->name }}</p>
        </div>
      @empty
        <div class="col">
          <p class="lead">Nobody is interested in this event for now</p>
        </div>
      @endforelse
    </div>
  </div>
@endsection
