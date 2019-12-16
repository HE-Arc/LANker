@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
  <section class="row no-gutters d-none d-lg-block text-light">
    <div class="col-12 d-flex">
      <div class="card lanker-dashboard-card">
        <img src="{{ asset('storage/home/home-image5.jpg') }}" class="deactivate lanker-dashboard-img lanker-dashboard-container card-img" alt="">
      </div>
      <div class="card-img-overlay bg-dark-60">
        <div class="container my-auto">
          <h1 class="font-weight-boldest display-1 mt-5 px-4">LANker</h1>
          <h1 class="display-4 mx-5 px-5"><em>Because we care about the gaming community.</em></h1>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="bg-white py-4">
  <div class="container">
    <div class="row no-gutters">
      <div class="col">
        <div class="px-4 my-4">
          <h1 class="display-5">What is LANker ?</h1>
          <p class="lead">LANker is an easy to use web application for LAN party managing. This web app is aimed at users wanting a fast approach to LAN organizing.</p>

          <p class="lead">Here's what people think of us</p>
          <blockquote class="blockquote">
            <p class="mb-0">Simple, elegant and user friendly. Trully a great app.</p>
            <footer class="blockquote-footer">Artan Sadiku in <cite title="Helvetic Gaming Magazine">Helvetic Gaming Magazine</cite></footer>
          </blockquote>
          <blockquote class="blockquote">
            <p class="mb-0">Only a few clicks and it was ready to go !</p>
            <footer class="blockquote-footer">Nicolas Praz in <cite title="Swissgamers">Swissgamers</cite></footer>
          </blockquote>
          <blockquote class="blockquote">
            <p class="mb-0">How come nobody never heard of this ?</p>
            <footer class="blockquote-footer">Nicolas Minnig in <cite title="HE-GamingCommunity">HE-GamingCommunity</cite></footer>
          </blockquote>
          <p class="lead">To start using LANker, you will need to register <a href="{{ route('register') }}">here</a>. After that is done, you can either join an existing event by visting the event page or create your own !</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="bg-light py-4">
  <div class="container">
    <div class="p-3">
      <h1 class="display-5">Don't know where to start ?</h1>
      <p class="lead">Here's some events that are currently ongoing</p>
    </div>
    <div class="row no-gutters">
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
            <h3 class="text-muted">Seems like there's no ongoing events...</h3>
          @endforelse
    </div>
  </div>
</div>
@endsection
