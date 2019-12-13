@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm">
      <div class="card text-center">

        <img id="image_preview_container" src="{{ url('storage/'.$user->avatar) }}" alt="" class="card-img avatar img-thumbnail"/>

        @if (Auth::check() && Auth::user()->id == $user->id)
        <form method="POST" enctype="multipart/form-data" id="upload_image_form" action="{{ route('change_profile_avatar', Auth::user()) }}" >
          @csrf
          {{ method_field('patch') }}
          <div class="card-img-overlay h-100 d-flex flex-column justify-content-end mt-3">
            <div class="form-group">
              <span class="btn btn-primary btn-file">
                Browse <input type="file" id="image" name="image" class="form-control" accept="image/*"/>
              </span>
              <button type="submit" class="btn btn-primary ml-1">Change</button>
            </div>
          </div>
        </form>
        @endunless

      </div>
      <input type="hidden" name="image" value="" class="form-control @error('image') is-invalid @enderror">
      @error('image')
          <span class="invalid-feedback" role="alert">
              <strong>The image is too big!</strong>
          </span>
      @enderror
    </div>
    <div class="col-sm">
      <h1>{{ $user->name }}</h1>

      @if(Auth::user()->hasRole('admin'))
        <p class="text-muted">Administrator</p>
      @else
        <p class="text-muted">User</p>
      @endif
      <h2>User information</h2>
      <p>{{ $user->email }}</p>
      <p>Joined on {{ date("d.m.Y",strtotime($user->created_at)) }}</p>
    </div>
    <div class="col-sm-6">
      <h1>Favorite games</h1>
        @foreach ($user->usergames()->get() as $usergame)
        <div class="">
          <form method="post" action="{{ route('remove_profile_game', $usergame) }}">
            @csrf
            {{ method_field('DELETE') }}
            <p>
              {{$usergame->game}}
              @if (Auth::check() && Auth::user()->id == $user->id)
              <button type="submit" class="btn btn-danger pull-right">Remove game</button>
              @endunless
            </p>
          </form>
        </div>
        @endforeach
        @if (Auth::check() && Auth::user()->id == $user->id)
        <form id="eventForm" method="post" action="{{ route('update_profile_games', Auth::user()) }}">
        @csrf
        {{ method_field('PUT') }}
          <div class="form-group">
            <input id="gameInput" type="text" class="form-control @error('games') is-invalid @enderror"  name="game" value="{{ old('game') }}" placeholder="Games">
            @error('games')
                <span class="invalid-feedback" role="alert">
                    <strong>You must enter a valid game!</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <span id="game_tags" class="d-block">
            </span>
          </div>
          <button type="submit" class="btn btn-primary ml-1 row">Update</button>
        </form>
        @endunless
    </div>
  </div>
  <div class="col my-4">
    @if (Auth::check() && Auth::user()->id == $user->id)
      <div class="row">
        <h3>Actions</h3>
      </div>
      <div class="row mb-2">
        <a href="{{ route('edit_profile', Auth::user()) }}" class="btn btn-primary mr-2">Change account informations</a>
        <form action="{{ route('delete_profile', Auth::user()) }}" method="POST"  onclick="return confirm('Are you sure?')">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" class="btn btn-danger" value="Delete profile"/>
        </form>
      </div>
    @endunless
    <div class="row">
      <div class="col pl-0 pr-0">
        <h3>Description</h3>
        <p>{{ $user->description }}</p>
      </div>
    </div>
    <div class="row">
      <div class="col pl-0 pr-0">
        <h3>Statistics</h3>
        <p><b>Number of participations to events: </b>{{ $participated }} <br>
          <b>Number of organised events: </b>{{ $organised }}
        </p>
      </div>
    </div>
  </div>
  <div class="col pl-0 pr-0">
    <!-- change accordion to blink collapsible ? -->
    <div class="accordion" id="organising">
      <div class="card">
        <div class="card-header" id="headingThree">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#organising_collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Organising events
            </button>
          </h2>
        </div>
        <div id="organising_collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#organising">
          <div class="card-body">
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
      </div>
    </div>

    <div class="accordion" id="participating">
      <div class="card">
        <div class="card-header" id="headingThree">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#participating_collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Participating events
            </button>
          </h2>
        </div>
        <div id="participating_collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#participating">
          <div class="card-body">
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

    <div class="accordion" id="organised">
      <div class="card">
        <div class="card-header" id="headingThree">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#organised_collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Organised events
            </button>
          </h2>
        </div>
        <div id="organised_collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#organised">
          <div class="card-body">
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
              <p>You aren't organising any upcoming event</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>

    <div class="accordion" id="participated">
      <div class="card">
        <div class="card-header" id="headingThree">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#participated_collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Participated events
            </button>
          </h2>
        </div>
        <div id="participated_collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#participated">
          <div class="card-body">
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
              <p>You aren't organising any upcoming event</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
@endsection
