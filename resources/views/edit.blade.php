@extends('layouts.app')

@section('content')
<div class="container my-5">
  <h1 class="display-4">Edit profile</h1>
  <form id="eventForm" enctype="multipart/form-data" method="POST" action="{{ route('update_profile', $user) }}">
    @csrf
    {{ method_field('PATCH') }}

    <div class="form-group">
      <img id="image_preview_container" src="{{ url('storage/'.$user->avatar) }}" class="lanker-sq-img-container lanker-border-5 rounded-circle border-light">
    </div>
    <div class="form-group">
      <button class="btn btn-primary btn-file">Change picture <input type="file" id="image" name="image" class="form-control" accept="image/*"/></button>
    </div>

    <div class="form-group">
      <label for="email">{{ __('E-Mail Address') }}</label>
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
    </div>

    <div class="form-group row">
      <div class="col">
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="col">
        <label for="password-confirm">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
      </div>
    </div>

    <div class="form-group">
      <label for="description">{{ __('Description') }}</label>
      <textarea id="description" class="form-control" name="description" rows="8" style="max-height: 300px; min-height: 200px;" maxlength="2048">{{ Auth::user()->description }}</textarea>
    </div>

    <div class="form-group">
      <label for="gameInput">Favourite games</label>
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

    <div class="form-group mb-0">
      <p class="text-primary">Leave the password field empty if you do not want to change it</p>
    </div>

    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary">{{ __('Submit changes') }}</button>
        <a href="{{ route('profile', Auth::user()->name) }}"></a>
    </div>
  </form>
</div>
<div class="container my-5">
  <h1 class="display-4">Favourite games</h1>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Game(s)</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse (Auth::user()->usergames()->get() as $usergame)
      <tr>
        <td>{{ $usergame->game }}</td>
        <td>
          <form method="post" action="{{ route('remove_profile_game', $usergame) }}">
            @csrf
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger pull-right">Remove game</button>
          </form>
        </td>
      </tr>
      @empty
        <tr>
          <td>
            <p class="text-muted">There's seems to be no favourite games</p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
