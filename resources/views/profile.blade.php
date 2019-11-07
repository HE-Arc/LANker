@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm">
      <div class="card" style="width: 18rem;">
        <img src="../img/goose.jpg" alt="" class="card-img-top img-thumbnail">
        @if (Auth::check() && Auth::user()->id == $user->id)
          <div class="card-body m-auto">
            <a href="#" class="btn btn-primary">Changer</a>
          </div>
        @endunless
      </div>
    </div>
    <div class="col-sm">
      <h1>Pierre</h1>
      <p class="text-muted">CEO of boicompany & govt. official</p>
      <h2>User information</h2>
      <p>pierre.kowalski@he-arc.ch</p>
      <p>Joined on 01.10.2014</p>
      <p>+41 012 345 954</p>
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
      <h3>Description</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
  </div>
  <div class="col">
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
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
