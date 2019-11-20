@extends('layouts.app')

@section('content')
<section class="row no-gutters align-items-center d-none d-lg-block">
  <div class="col-12 d-flex">
    <img src="{{ asset('storage/home/home-image4.jpg') }}" class="img-fluid deactivate fit-image" alt="">
    <?php // TODO: add logo here ?>
  </div>
</section>
<div class="bg-light">
  <div class="row">
    <div class="col-md-12 col-lg-12 p-4 my-5">
      <h1 class="font-weight-boldest display-4 px-4 mb-2">Welcome to LANker</h1>
      <p class="lead px-4">LANker is an easy to use web application for lan party managing. This web app is aimed at users wanting a fast approach to lan organizing. Supervisors will find an outstanding experience using new technology to manage lan events.</p>
      <blockquote class="blockquote px-4">
        <p class="mb-0">Simple, elegant and user friendly. Trully a great app.</p>
        <footer class="blockquote-footer">Artan Sadiku in <cite title="Gaming Magazine">Gaming Magazine</cite></footer>
      </blockquote>
      <blockquote class="blockquote px-4">
        <p class="mb-0">Only a few clicks and it was ready to go !</p>
        <footer class="blockquote-footer">Nicolas Praz in <cite title="Neuchgamers">Neuchgamers</cite></footer>
      </blockquote>
      <blockquote class="blockquote px-4">
        <p class="mb-0">How come nobody never heard of this ?</p>
        <footer class="blockquote-footer">Nicolas Minnig in <cite title="HE-GamingCommunity">HE-GamingCommunity</cite></footer>
      </blockquote>
    </div>
    {{-- <div class="col-md-5 d-none d-lg-block">
        <img src="{{ asset('storage/home/home-image4.jpg') }}" class="img-fluid img-object-fit" alt="">
    </div> --}}
  </div>
</div>

<h1 class="display-5">Where to start ?</h1>
<p class="lead">To start using LANker, you will need to register <a href="{{ route('register') }}">here</a>. After that is done, you can either join an existing event by visting the event page or create your own !</p>

<h1 class="display-5">Ongoing events</h1>

<div class="container">
  {{-- @forelse ($events as $event)
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
  @endforelse --}}
</div>
@endsection
