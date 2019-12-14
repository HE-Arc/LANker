@extends('layouts.app')

@section('content')
<div class="container my-5">
  <div class="row">
    <div class="col">
      <h1 class="display-4">Edit profile</h1>
      <form id="eventForm" enctype="multipart/form-data" method="POST" action="{{ route('update_profile', $user) }}">
        @csrf
        {{ method_field('PATCH') }}

        <div class="form-group">
          <img src="{{ url('storage/'.$user->avatar) }}" class="lanker-sq-img-container lanker-border-5 border-light">
        </div>
        <div class="form-group">
          <button class="btn btn-primary btn-file">Change picture <input type="file" id="image" name="image" class="form-control" accept="image/*"/></button>
        </div>

        {{-- <div class="card text-center">
          <div class="card-body">
            <img id="image_preview_container" src="{{ url('storage/'.$user->avatar) }}" alt="" class="card-img avatar img-thumbnail" style="width: 18rem; "/>
            @if (Auth::check() && Auth::user()->id == $user->id)
            <form method="POST" enctype="multipart/form-data" id="upload_image_form" action="{{ route('change_profile_avatar', $user) }}" >
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
        </div>
        <input type="hidden" name="image" value="" class="form-control @error('image') is-invalid @enderror">
        @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>The image is too big!</strong>
            </span>
        @enderror --}}

        <div class="form-group row">
          <div class="col">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">
          </div>
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

        <div class="form-group row">
          <div class="col">
            <label for="description">{{ __('Description') }}</label>
            <textarea id="description" class="form-control" name="description" rows="8" maxlength="2048">{{ Auth::user()->description }}</textarea>
          </div>
        </div>

        <div class="form-group row">
          <div class="col">
            <label for="gameInput">Favourite games</label>
            <input id="gameInput" type="text" class="form-control @error('games') is-invalid @enderror"  name="game" value="{{ old('game') }}" placeholder="Games">
            @error('games')
            <span class="invalid-feedback" role="alert">
              <strong>You must enter a valid game!</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <div class="col">
            <span id="game_tags" class="d-block">
            </span>
          </div>
        </div>

        <div class="form-group row mb-0">
          <div class="col">
            <p class="text-primary">Leave the password field empty if you do not want to change it</p>
          </div>
        </div>

        <div class="form-group row mb-0">
          <div class="col">
            <button type="submit" class="btn btn-primary">{{ __('Submit changes') }}</button>
            <a href="{{ route('profile', Auth::user()->name) }}"></a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row my-3">
    <div class="col">
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
  </div>
</div>
@endsection
