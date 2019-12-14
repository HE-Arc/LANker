@extends('layouts.app')

@section('content')
<div class="container my-5">
  <div class="row">
    <div class="col">
      <div class="card mb-3">
        <div class="row no-gutters">
          {{-- <div class="col-sm-4 d-none d-sm-block">
            <img src="{{ url('storage/'.$user->avatar) }}" class="card-img p-3" alt="user avatar">
          </div> --}}
          <div class="col-md-8">
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h2 class="card-title">{{ $user->name }}</h2>
                  @if(Auth::user()->hasRole('admin'))
                    <p class="card-text text-muted">Administrator</p>
                  @else
                    <p class="card-text text-muted">User</p>
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>User information</h3>
                  <p>{{ $user->email }}</p>
                  <p>Joined on {{ date("d.m.Y",strtotime($user->created_at)) }}</p>
                  <p>Participating in {{ $participated }} event(s)</p>
                  <p>Organised {{ $organised }} event(s)</p>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h3>Actions</h3>
                  <form action="{{ route('delete_profile', Auth::user()) }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      @if (Auth::check() && Auth::user()->id == $user->id)
                      <a href="{{ route('edit_profile', Auth::user()) }}" class="btn btn-primary">Change account informations</a>
                      <input type="submit" class="btn btn-danger" value="Delete profile" onclick="return confirm('Are you sure?')"/>
                      @endunless
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-none d-md-block">
            <img src="{{ url('storage/'.$user->avatar) }}" class="card-img" alt="user avatar">
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col">
      <h3>Description</h3>
      <p>{{ $user->description }}</p>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <h3>Events</h3>
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
</div>
@endsection
