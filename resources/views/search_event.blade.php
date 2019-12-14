@extends('layouts.app')

@section('content')
  <div class="container my-5">
    <h1 class="display-4">Search result</h1>
    <h2>Users</h2>
    @forelse ($users as $user)
      @component('components/profile_card')
        @slot('avatar')
          {{$user->avatar}}
        @endslot
        @slot('name')
          {{$user->name}}
        @endslot
        @slot('description')
          {{$user->description}}
        @endslot
        @slot('email')
          {{$user->email}}
        @endslot
        @slot('created_at')
          {{$user->created_at}}
        @endslot
      @endcomponent
    @empty
    <h3 class="text-muted">No users founds...</h3>
    @endforelse
    <div class="">
      <h2>Events</h2>
      <div class="row">
        @forelse ($events as $event)
          @component('components/event_card')
            @slot('banner')
              {{$event->banner}}
            @endslot
            @slot('name')
              {{$event->name}}
            @endslot
            @slot('description')
              {{$event->description}}
            @endslot
            @slot('dates')
              {{$event->getStartDate().$event->getEndDate()}}
            @endslot
            @slot('created_at')
              {{$event->created_at}}
            @endslot
          @endcomponent
          @empty
          <h3 class="text-muted">No events founds...</h3>
          @endforelse
      </div>
    </div>
  </div>
@endsection
