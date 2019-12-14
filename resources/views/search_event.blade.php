@extends('layouts.app')

@section('content')
  <div class="container my-5">
    <h1 class="display-4">Search result</h1>
    <h2>Users</h2>
    @forelse ($users as $user)
      <a href="{{ route('profile', $user->name) }}">{{ $user->name }}</a>
    @empty
      <h3 class="text-muted">No users founds...</h3>
    @endforelse
    <h2>Events</h2>
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
@endsection
