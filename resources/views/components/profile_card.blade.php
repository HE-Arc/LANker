<div class="card mb-3 profile_card">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="{{ url('storage/'.$avatar) }}" class="card-img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h1 class="card-title">{{ $name }}</h5>
        <p>{{ $email }}</p>
        <p class="card-text formatted">{!! $description !!}</p>
        <p>Joined on {{ date("d.m.Y",strtotime($created_at)) }}</p>
        <a class="btn btn-primary" href="{{ route('profile', $name) }}">Visit Profile</a>
      </div>
    </div>
  </div>
</div>
