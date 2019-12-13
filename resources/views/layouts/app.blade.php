<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.autocomplete.min.js') }}" defer></script>
    {{-- <script
      src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
      integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
      crossorigin="anonymous"></script> --}}
    <script src="{{ asset('js/taginput.js') }}" defer></script>
    <script src="{{ asset('js/username_autocomplete.js') }}" defer></script>
    <script src="{{ asset('js/image_preview.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lanker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/file_input.css') }}" rel="stylesheet">
    <link href="{{ asset('css/image_preview.css') }}" rel="stylesheet">
    <link href="{{ asset('css/autocomplete_suggestion_style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

  </head>
  <body>
    <div id="app">
      <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #273c75;">
          <a class="navbar-brand" href="{{ route('dashboard') }}">LANker</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              @auth
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('form_event') }}">{{ __('Create event') }}</a>
              </li>
              @endauth
              <!-- My Events here -->
            </ul>
            <ul class="navbar-nav">
              <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('search_event') }}">
                 @csrf
                <input class="form-control mr-sm-2" name="searchvalue" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 d-none" type="submit">Search</button>
              </form>
              @guest
                  <li class="nav-item">
                      <a class="nav-link active" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item active">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                  @endif
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if(Auth::user()->can('browse_admin'))
                          <a class="dropdown-item" href="{{ url('lanker_admin') }}">Admin</a>
                        @endif
                          <a class="dropdown-item" href="{{ route('profile', Auth::user()->name) }}">Profile</a>

                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
            </ul>
          </div>
        </nav>
      </header>

      <main class="my-5">
          @yield('content')
      </main>
    </div>
  </body>
</html>
