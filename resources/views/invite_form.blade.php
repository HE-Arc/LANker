@extends('layouts.app')

@section('content')
<div class="container">
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
                                <input id="mail" type="text" class="form-control" name="email" value="" required autofocus placeholder="Email adress">
                                <input id="event_name" type="text" name="event_name" value="{{$event->name}}" hidden>
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
                                <input id="mail" type="text" class="form-control" name="username" value="" required autofocus placeholder="Username">
                                <input id="event_name" type="text" name="event_name" value="{{$event->name}}" hidden>
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
