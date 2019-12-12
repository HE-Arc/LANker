@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="display-4">Create Event</h1>
    {{-- <div class="card"> --}}
    {{-- <form class="card-body form-col ml-2 mr-2" enctype="multipart/form-data" method="POST" action="{{ route('create_event') }}"> --}}
    <form enctype="multipart/form-data" method="POST" action="{{ route('create_event') }}">
        @csrf
        <div class="form-group row">
          <div class="col">
            <label for="event_name">Event name</label>
            <input id="event_name" type="text" class="form-control @error('event_name') is-invalid @enderror" name="event_name" value="{{ old('event_name') }}" placeholder="Event name" required>
            @error('event_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col">
            <label for="host_name">Host name</label>
            <input id="host_name" type="text" class="form-control @error('host_name') is-invalid @enderror" name="host_name" value="{{ old('host_name') }}" placeholder="Host name" required>
            @error('host_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <div class="col">
            <img src="{{ url('storage/banners/dreamhack.jpg')}}" id="image_preview_container" class="img-thumbnail event-banner" alt="">
          </div>
        </div>
        <div class="form-group row">
          <div class="col">
            <div class="input-group">
              <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
              @error('image')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
              <label class="custom-file-label" for="image">Choose file</label>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <div class="col">
            <label for="start_date">Start Date</label>
            <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" placeholder="DD-MM-YYYY" required>
            @error('start_date')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col">
            <label for="end_date">End Date</label>
            <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" placeholder="DD-MM-YYYY" required>
            @error('end_date')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <div class="col">
            <label for="start_time">From</label>
            <input id="start_time" type="text" class="form-control col @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time') }}" placeholder="HH:MM" required>
            @error('start_time')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col">
            <label for="end_time">To</label>
            <input id="end_time" type="text" class="form-control col @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time') }}" placeholder="HH:MM" required>
            @error('end_time')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <div class="col">
            <label for="location">Location</label>
            <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" placeholder="Location" required>
            @error('location')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <div class="col">
            <label for="game">Game</label>
            <input id="gameInput" type="text" class="form-control @error('game') is-invalid @enderror" name="game" value="{{ old('game') }}" placeholder="Games">
            @error('game')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row d-block">
          <div class="col">
            <label for="">Selected games</label>
            <span id="game_tags" class="d-block">
            </span>
          </div>
        </div>

        <div class="form-group row">
          <div class="col">
            <label for="description">Description</label>
            <textarea id="description" class="form-control  @error('public') is-invalid @enderror" name="description" value="{{ old('description') }}">{{{ old('description') }}}</textarea>
            @error('public')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <div class="col">
            <label for="price">Price</label>
            <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="0.0">
            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col">
            <label for="nb_chairs">Number of seats</label>
            <input id="nb_chairs" type="text" class="form-control @error('nb_chairs') is-invalid @enderror" name="nb_chairs" value="{{ old('nb_chairs') }}" placeholder="100">
            @error('nb_chairs')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group form-check row">
          <div class="col">
            <input class="form-check-input" type="checkbox" id="private" name="private" @if (old('private')) checked @endif>
            <label class="form-check-label" for="private">Private Event</label>
          </div>
        </div>

        <div class="form-group row">
          <div class="col">
            <button class="btn btn-primary mr-2" type="submit">Create event</button>
            <a class="btn btn-secondary" href="{{ url()->previous() }}">Cancel</a>
          </div>
        </div>
    </form>
</div>
@endsection
