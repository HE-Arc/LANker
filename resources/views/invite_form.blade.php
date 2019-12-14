@extends('layouts.app')

@section('content')
<div class="container my-5 py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Invite by Email') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('send_invite_event') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autofocus placeholder="Email adress">
                                <input id="event_name" type="text" name="event_name" value="{{$event->name}}" hidden>
                                @error('email')
                                <span class="invalid-feedback">
                                  <strong>invalid email address</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6">
                              <button class="btn btn-primary mr-2" type="submit" >Send invite</button>
                          </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Invite by username') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('send_invite_event_username') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="" required autofocus placeholder="Username">
                                <input id="event_name" type="text" name="event_name" value="{{$event->name}}" hidden>
                                @error('username')
                                <span class="invalid-feedback">
                                  <strong>Unknown username</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6">
                              <button class="btn btn-primary mr-2" type="submit" >Send invite</button>
                          </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
