@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="display-4">Events</h1>
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
        @slot('created_at')
          {{$event->created_at}}
        @endslot
      @endcomponent
    @empty
      <h3 class="text-muted">Seems like there's no ongoing events...</h3>
    @endforelse
  </div>
@endsection
