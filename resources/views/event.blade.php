@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="justify-content-center">
      <h1>{{ $event->name }}</h1>
      <div class="card p-3">
        <div class="row">
          <div class="col">
            @image(['name'=>'dreamhack.jpg','alt'=>'event image','id'=>'event-image'])@endimage
          </div>

          <div class="col">
            <h2>General informations</h2>
            <div class="row my-2">
              @event_info(['id'=>'host','name'=>'Host','value'=>'HE-Arc'])@endevent_info
              @event_info(['id'=>'location','name'=>'Location','value'=>'Neuchâtel'])@endevent_info
            </div>
            <div class="row my-2">
              @event_info(['id'=>'price','name'=>'Price','value'=>'Free'])@endevent_info

              @component('components/event_info')
                @slot('id')
                  date
                @endslot
                @slot('name')
                  Host
                @endslot
                @slot('value')
                  {{ $event->date_start }}
                @endslot
              @endcomponent
              {{-- @event_info(['id'=>'date','name'=>'Host','value'=>''])@endevent_info --}}
            </div>
            <div class="row my-2">
              @event_info(['id'=>'time','name'=>'Time','value'=>'9:00-22:00'])@endevent_info
              @event_info(['id'=>'seats','name'=>'Nb. seats','value'=>'100'])@endevent_info
            </div>
          </div>
        </div>
        <div class="row m-0 my-2">
          <div class="col">
            <h2>Description</h2>
            <p>{{ $event->description }}</p>
          </div>
        </div>
        <div class="row m-0 my-2">
          <div class="col">
            @auth
              @if ($event->users()->where('event_id', $event->id)->exists())
                <a href="{{ route('leave_event', $event->id) }}" class="btn btn-primary">Leave event</a>
              @else
                <a href="{{ route('join_event', $event->id) }}" class="btn btn-primary">Join event</a>
              @endif
            @else
              <a href="{{ route('login') }}" class="btn btn-primary">Login first</a>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
