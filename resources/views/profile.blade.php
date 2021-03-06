@extends('layouts.app')

@section('content')
  <div class="container my-5">
    <img src="{{ url('storage/'.$user->avatar) }}" class="mx-auto d-block lanker-sq-img-container rounded-circle lanker-border-5 border-light" alt="user avatar">
    <h1 class="display-4 text-center">{{ $user->name }}</h1>
    <div class="row mt-5">
      <div class="col-lg mx-2 bg-light p-4">
        <h3 class="mb-3">General information</h3>
        <table class="table">
          <tr>
            <th>Account role</th>
            <td>
              @if($user->hasRole('admin'))
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
            <th>Participation</th>
            <td>{{ $participated }} event(s)</td>
          </tr>
          <tr>
            <th>Organisation</th>
            <td>{{ $organised }} event(s)</td>
          </tr>
        </table>
        <hr>
        @if(!Auth::guest() and (Auth::id() == $user->id or Auth::user()->hasRole('admin')))
          <form action="{{ route('delete_profile', Auth::user()) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            @if(Auth::user()->id == $user->id)
              <a href="{{ route('edit_profile', Auth::user()) }}" class="btn btn-primary">Change account informations</a>
            @endif
            <input type="submit" class="btn btn-danger" value="Delete profile" onclick="return confirm('Are you sure?')"/>
          </form>
        @endif
      </div>

      <div class="col-lg mx-2 bg-light p-4">
        <h3 class="mb-3">About me</h3>
        <table class="table">
          <tr>
            <th>Description</th>
            <td class="text-break">{{ $user->description }}</td>
          </tr>
        </table>
      </div>
    </div>
    <h3 class="my-4">Favorite games</h3>
    <div class="row">
      @forelse ($user->usergames()->get() as $usergame)
        @game_card(['cover'=>$usergame->cover,'title'=>$usergame->game])@endgame_card
      @empty
        @if (!Auth::guest() and Auth::user()->id == $user->id)
          <div class="col">
            <p class="text-muted">It seems like you don't have any favourite games, add them <a href="{{ route('edit_profile', Auth::user()) }}">here</a>.</p>
          </div>
        @else
          <div class="col">
            <p class="text-muted">It seems like this user doesn't have any favourite games.</p>
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
      <li class="nav-item">
        <a class="nav-link" id="pills-organised-events-tab" data-toggle="pill" href="#pills-organised-events" role="tab" aria-controls="pills-organised-events" aria-selected="false">Organised events</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-participated-events-tab" data-toggle="pill" href="#pills-participated-events" role="tab" aria-controls="pills-participated-events" aria-selected="false">Participated events</a>
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
            @if (!Auth::guest() and Auth::user()->id == $user->id)
              <div class="col">
                <p>You aren't organising any upcoming event</p>
              </div>
            @else
              <div class="col">
                <p>This user isn't organising any upcoming event</p>
              </div>
            @endif
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
            @if (!Auth::guest() and Auth::user()->id == $user->id)
              <div class="col">
                <p>You aren't participating in any upcoming event</p>
              </div>
            @else
              <div class="col">
                <p>This user isn't participating in any upcoming event</p>
              </div>
            @endif
          @endforelse
        </div>
      </div>
      <div class="tab-pane fade" id="pills-organised-events" role="tabpanel" aria-labelledby="pills-organised-events-tab">
        <div class="row">
          @forelse($organised_evt as $event)
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
            @if (!Auth::guest() and Auth::user()->id == $user->id)
              <div class="col">
                <p>The events that you are organising have not yet expired</p>
              </div>
            @else
              <div class="col">
                <p>This user has not organised any expired events</p>
              </div>
            @endif
          @endforelse
        </div>
      </div>
      <div class="tab-pane fade" id="pills-participated-events" role="tabpanel" aria-labelledby="pills-participated-events-tab">
        <div class="row">
          @forelse($participated_evt as $event)
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
            @if (!Auth::guest() and Auth::user()->id == $user->id)
              <div class="col">
                <p>The events that you are participating in have not yet expired</p>
              </div>
            @else
              <div class="col">
                <p>This user has not participated in any expired events</p>
              </div>
            @endif
          @endforelse
        </div>
      </div>
    </div>
  </div>
@endsection
