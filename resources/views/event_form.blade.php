@extends('layouts.app')

@section('content')
<div class="container">
  <div class="container">
    <h1 class="display-4">Create Event</h1>
    <div class="card">
      <form class="card-body form-col ml-2 mr-2">
          <div class="form-group row">
            <label for="name">Event name</label>
            <input type="text" class="form-control" id="name" placeholder="Name">
          </div>

          <div class="form-group row">
            <div class="form-row">
              <div class="col-xs-6">
                <img src="../img/goose.jpg" alt="" class="img-thumbnail float-left">
              </div>
              <div class="col-xs-6 align-self-end">
                <button class="btn btn-primary" type="submit">Upload an image</button>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <div class="form-row">
              <div class="col-3 mr-5">
              <label for="date">Date</label>
              <input type="text" class="form-control" id="date" placeholder="DD/MM/YYYY">
              </div>
              <div class="col-8">
                <label for="start">Time</label>
                <div class="form-group row">
                  <label for="start" class="col-2 text-right align-self-center">From</label>
                  <input type="text" class="form-control col " id="start" placeholder="Start">
                  <label for="end" class="col-2 text-right align-self-center">To</label>
                  <input type="text" class="form-control col" id="end" placeholder="End">
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" placeholder="Location">
          </div>

          <div class="form-group row">
            <label for="game">Game</label>
            <input type="text" data-role="tagsinput" class="form-control" id="game" placeholder="Games">
          </div>

          <div class="form-group row">
            <label for="description">Description</label>
            <textarea class="form-control" id="description"></textarea>
          </div>

          <div class="row">
            <button type="button" class="btn btn-primary mr-2">Create event</button>
            <button type="button" class="btn btn-secondary">Cancel</button>
          </div>

        </form>

    </div>
  </div>
</div>
@endsection
