<div class="card mb-3">
  <div class="embbed-responsive embed-responsive-16by9">
    <img src="{{ url('storage/'.$banner) }}" class="card-img-top fit-image" alt="...">
  </div>
  <div class="card-body">
    <h5 class="card-title">{{ $name }}</h5>
    <p class="card-text">{{ $description }}</p>
    <p class="card-text"> <b>{{$dates}}</b></p>
    <a href="{{ route('event', $name) }}" class="btn btn-primary">Go to event</a>
    <p class="card-text"><small class="text-muted">Created on {{ $created_at }}</small></p>
  </div>
</div>
