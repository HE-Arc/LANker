@extends('layouts.app')

@section('content')
<div class="container my-5">
  <div class="justify-content-center">
    <h1>{{ $event->name }}</h1>
    <div class="card p-3">
      <img src="{{ url('storage/'.$event->banner)}}" alt="event image" id="event-image" class="card-img-top img-fluid event-banner">
      <div class="row">
        <div class="col">
          <h2>General informations</h2>
          <div class="row">
            @event_info(['id'=>'host','name'=>'Host','value'=>'HE-Arc'])@endevent_info
            @event_info(['id'=>'location','name'=>'Location','value'=>$event->location])@endevent_info
          </div>
          <div class="row">
            @event_info(['id'=>'price','name'=>'Price','value'=>$event->getPrice()])@endevent_info

            @component('components/event_info')
              @slot('id')
                date
              @endslot
              @slot('name')
                Date
              @endslot
              @slot('value')
                {{ $event->getStartDate().$event->getEndDate() }}
              @endslot
            @endcomponent
            {{-- @event_info(['id'=>'date','name'=>'Host','value'=>''])@endevent_info --}}
          </div>
          <div class="row">
            @event_info(['id'=>'time','name'=>'Time','value'=>$event->getStartTime().'-'.$event->getEndTime()])@endevent_info
            @event_info(['id'=>'seats','name'=>'Nb. seats','value'=>$event->getNbSeats()])@endevent_info
          </div>
          <h2>Games</h2>
          <div class="row">
            @foreach ($event->eventgames()->get() as $eventgame)
              <div class="event-info col-sm">{{$eventgame->game}}</div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h2>Description</h2>
          <p>{{ $event->description }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          @auth
            @if ($event->users()->where('event_id', $event->id)->exists())
              <a href="{{ route('leave_event', $event->id) }}" class="btn btn-primary">Leave event</a>
            @else
              <a href="{{ route('join_event', $event->id) }}" class="btn btn-primary">Join event</a>
            @endif
            <a href="{{ route('invite_event', $event) }}" class="btn btn-primary">Share</a>
            <form class="lanker-inline-form" action="{{ route('delete_event', $event) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this event?');">
              @csrf
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-danger" name="button">Delete Event</button>
            </form>
          @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login first</a>
          @endauth
        </div>
        <div class="row">
          <div class="col">
          <div class="accordion" id="organising">
            <div class="card">
              <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#organising_collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    {{$event->users()->count()}} people interested
                  </button>
                </h2>
              </div>
              <div id="organising_collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#organising">
                <div class="card-body">
                  <div class="container">
                    <div class="row">
                    @forelse($event->users()->get() as $user)
                    @user_preview(['user'=>$user,'class'=>'col-md-4 col-sm-6 lanker-user-preview']) @enduser_preview
                    @empty
                    <div class="col">
                      <p>Nobody is interested in this event for now</p>
                    </div>
                    @endforelse
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
