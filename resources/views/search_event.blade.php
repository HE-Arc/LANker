@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="display-4">Search result</h1>
    @forelse ($events as $event)
      @component('components/event_card')
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
      <h3 class="text-muted">No results founds...</h3>
    @endforelse
  </div>
@endsection
