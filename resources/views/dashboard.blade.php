@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="display-4">Events</h1>

  @forelse ($events as $event)
    <div class="card mb-3">
      <div class="embbed-responsive embed-responsive-16by9">
        <img src="img/dummy.jpg" class="card-img-top fit-image" alt="...">
      </div>
      <div class="card-body">
        <h5 class="card-title">{{ $event->name }}</h5>
        <p class="card-text">{{ $event->description }}</p>
        <p class="card-text"><small class="text-muted">Created on {{ $event->created_at }}</small></p>
      </div>
    </div>
  @empty
    <h3 class="text-muted">Seems like there's no ongoing events...</h3>
  @endforelse
</div>
@endsection
