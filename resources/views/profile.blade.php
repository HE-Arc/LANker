@extends('layouts.app')

@section('content')
  <div class="container my-5">
    <img src="{{ url('storage/'.$user->avatar) }}" class="mx-auto d-block lanker-sq-img-container rounded-circle lanker-border-5 border-light" alt="user avatar">
    <h1 class="display-4 text-center">{{ $user->name }}</h1>
    <div class="row mt-5">
      <div class="col mx-2 bg-light p-4">
        <h3 class="mb-3">General information</h3>
        <table class="table">
          <tr>
            <th>Account role</th>
            <td>
              @if(Auth::user()->hasRole('admin'))
                Administrator
              @else
                User
              @endif
            </td>
          </tr>
          <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
          </tr>
          <tr>
            <th>Joined on</th>
            <td>{{ date("d.m.Y",strtotime($user->created_at)) }}</td>
          </tr>
          <tr>
            <th>Participating in</th>
            <td>{{ $participated }} event(s)</td>
          </tr>
          <tr>
            <th>Organised</th>
            <td>{{ $organised }} event(s)</td>
          </tr>
        </table>
        <hr>
        @if(Auth::user()->id == $user->id)
          <form action="{{ route('delete_profile', Auth::user()) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <a href="{{ route('edit_profile', Auth::user()) }}" class="btn btn-primary">Change account informations</a>
            <input type="submit" class="btn btn-danger" value="Delete profile" onclick="return confirm('Are you sure?')"/>
          </form>
        @endif
      </div>
      <div class="col mx-2 bg-light p-4">
        <h3 class="mb-3">About me</h3>
        <table class="table">
          <tr>
            <th>Description</th>
            <td>{{ $user->description }}</td>
          </tr>
        </table>
      </div>
    </div>
    <h3 class="my-4">Favorite games</h3>
    <div class="row">
      @forelse ($user->usergames()->get() as $usergame)
        @game_card(['cover'=>$usergame->cover,'title'=>$usergame->game])@endgame_card
      @empty
        @if (Auth::user()->id == $user->id)
          <div class="col">
            <p class="text-muted">It seems like you don't have any favourite games, add them <a href="{{ route('edit_profile', Auth::user()) }}">here</a>.</p>
          </div>
        @endif
      @endforelse
    </div>

    <h3 class="my-4">Events</h3>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-organising-events-tab" data-toggle="pill" href="#pills-organising-events" role="tab" aria-controls="pills-organising-events" aria-selected="true">Organising events</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-participating-events-tab" data-toggle="pill" href="#pills-participating-events" role="tab" aria-controls="pills-participating-events" aria-selected="false">Participating events</a>
      </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-organising-events" role="tabpanel" aria-labelledby="pills-organising-events-tab">
        <div class="row">
          @forelse($organising_evt as $event)
            @component('components/event_card')
              @slot('banner')
                {{$event->banner}}
              @endslot
              @slot('name')
                {{$event->name}}
              @endslot
              @slot('dates')
                {{$event->getStartDate().$event->getEndDate()}}
              @endslot
              @slot('description')
                {{$event->description}}
              @endslot
              @slot('created_at')
                {{$event->created_at}}
              @endslot
            @endcomponent
          @empty
            <p>You aren't organising any upcoming event</p>
          @endforelse
        </div>
      </div>
      <div class="tab-pane fade" id="pills-participating-events" role="tabpanel" aria-labelledby="pills-participating-events-tab">
        <div class="row">
          @forelse($participating_evt as $event)
            @component('components/event_card')
              @slot('banner')
                {{$event->banner}}
              @endslot
              @slot('name')
                {{$event->name}}
              @endslot
              @slot('dates')
                {{$event->getStartDate().$event->getEndDate()}}
              @endslot
              @slot('description')
                {{$event->description}}
              @endslot
              @slot('created_at')
                {{$event->created_at}}
              @endslot
            @endcomponent
          @empty
            <p>You aren't organising any upcoming event</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
@endsection
