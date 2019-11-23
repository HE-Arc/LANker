@extends('layouts.app')

@section('content')
<script src="{{ asset('js/image_preview.js') }}" defer></script>

<div class="container">
  <div class="row">
    <div class="col-sm">
      <div class="card text-center" style="width: 18rem; ">

        <img id="image_preview_container" src="{{ url('storage/'.$user->avatar) }}" alt="" class="card-img avatar img-thumbnail"/>

        @if (Auth::check() && Auth::user()->id == $user->id)
        <form method="POST" enctype="multipart/form-data" id="upload_image_form" action="{{ route('change_profile_avatar', $user) }}" >
          @csrf
          {{ method_field('patch') }}
          <div class="card-img-overlay h-100 d-flex flex-column justify-content-end mt-3">
            <div class="form-group">
              <span class="btn btn-primary btn-file">
                Browse <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*"/>
              </span>
              @error('image')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              <button type="submit" class="btn btn-primary ml-1">Change</button>
            </div>
          </div>
        </form>
        @endunless

      </div>
    </div>
    <div class="col-sm">
      <h1>{{ $user->name }}</h1>
      <p class="text-muted">CEO of boicompany & govt. official</p>
      <h2>User information</h2>
      <p>{{ $user->email }}</p>
      <p>Joined on {{ date("d.m.Y",strtotime($user->created_at)) }}</p>
    </div>
    <div class="col-sm-6">
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
  </div>
  <div class="col pl-0 pr-0">
    <!-- change accordion to blink collapsible ? -->
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingThree">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              Participating events
            </button>
          </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
            @forelse ($user->events as $event)
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
              <p>You haven't participated in any event</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
