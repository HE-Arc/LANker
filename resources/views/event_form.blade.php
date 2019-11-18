@extends('layouts.app')

@section('content')
<div class="container">
  <div class="container">
    <h1 class="display-4">Create Event</h1>
    <div class="card">
      <form class="card-body form-col ml-2 mr-2" method="POST" action="{{ route('create_event') }}">
          @csrf

          <div class="form-group row">
            <label for="name">Event name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group row">
            <div class="form-row">
              <div class="col-xs-6">
                <img src="../img/goose.jpg" class="img-thumbnail float-left" alt="">
              </div>
              <div class="col-xs-6 align-self-end mt-2">
                <button type="submit" class="btn btn-primary" >Upload an image</button>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <div class="form-row">
              <div class="col-xs-6  mr-4">
                <label for="date">Date</label>
                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" placeholder="DD-MM-YYYY" pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}" required>
                @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="col-xs-6">
                <label for="start">Time</label>
                <div class="form-row">
                  <label class="col-0 align-self-center" for="start" >From</label>
                  <input id="start" type="text" class="form-control col @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}" placeholder="HH:MM" required>
                  @error('start')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <label class="col-0 align-self-center" for="end" >To</label>
                  <input id="end" type="text" class="form-control col @error('end') is-invalid @enderror" name="end" value="{{ old('end') }}" placeholder="HH:MM" required>
                  @error('end')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="location">Location</label>
            <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" placeholder="Location" required>
            @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group row">
            <label for="game">Game</label>
            <input id="game" type="text" class="form-control @error('game') is-invalid @enderror"  name="game" value="{{ old('game') }}" placeholder="Games" required>
            @error('game')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group row">
            <label for="description">Description</label>
            <textarea id="description" class="form-control  @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"></textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="row">
            <button class="btn btn-primary mr-2" type="submit" >Create event</button>
            <button class="btn btn-secondary" type="submit" >Cancel</button>
          </div>

        </form>
    </div>
  </div>
</div>
@endsection