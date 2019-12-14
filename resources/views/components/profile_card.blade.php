<div class="card mb-3 p-2">
  <div class="row no-gutters">
    <div class="col-md-2">
      <img src="{{ url('storage/'.$avatar) }}" class="card-img lanker-profile-card" alt="...">
    </div>
    <div class="col-md-8 my-auto">
      <div class="card-body p-0">
        <h4 class="card-title my-auto"><a href="{{ route('profile', $name)}}">{{ $name }}</a></h4>
      </div>
    </div>
  </div>
</div>
