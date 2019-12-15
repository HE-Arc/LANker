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
  <script src="{{ asset('js/taginput.js') }}" defer></script>
  <script src="{{ asset('js/username_autocomplete.js') }}" defer></script>
  <script src="{{ asset('js/image_preview.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/lanker.css') }}" rel="stylesheet">
  <link href="{{ asset('css/file_input.css') }}" rel="stylesheet">
  <link href="{{ asset('css/image_preview.css') }}" rel="stylesheet">
  <link href="{{ asset('css/autocomplete_suggestion_style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
</head>

<body>
  <div id="app">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-mazarine-blue">
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
  <main>
    @yield('content')
  </main>
</div>
<footer class="bg-black text-white py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg">
        <h5 class="my-3">About us</h5>
        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>
      <div class="col-lg">
        <h5 class="my-3">Social networks</h5>
        <p class="text-muted">Follow us on</p>
        <a href="#"><i class="fab fa-twitter fa-lg mx-2"></i></a>
        <a href="#"><i class="fab fa-facebook fa-lg mx-2"></i></a>
        <a href="#"><i class="fab fa-instagram fa-lg mx-2"></i></a>
        <a href="#"><i class="fab fa-snapchat fa-lg mx-2"></i></a>
      </div>
      <div class="col-lg">
        <h5 class="my-3">Contact us</h5>
        <address>
          <strong>LANker dev team</strong><br>
          <i class="fas fa-map-marker-alt"></i> Espace de l'Europe, 11<br>
          2000 Neuchâtel, Switzerland<br>
          <i class="far fa-envelope"></i> info@lankerteam.ch<br>
          <i class="fas fa-phone"></i> +41 (0)32 943 43 13
        </address>
      </div>
      <div class="col-lg">
        <h5 class="my-3">&nbsp;</h5>
        <p class="text-lg-right">&copy; 2019 LANker</p>
        <button class="btn btn-light mx-auto mx-md-0 ml-lg-auto d-block"><a href="#" class="text-decoration-none text-dark">Back to top <i class="fa fa-arrow-up"></i></a></button>
      </div>
    </div>
  </div>
</footer>
</body>
</html>
