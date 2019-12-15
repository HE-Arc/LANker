<div class="col-lg-6 col-md">
  <div class="card m-3">
    <div class="embbed-responsive embed-responsive-16by9">
      <img src="{{ url('storage/'.$banner) }}" class="card-img-top event-banner" alt="...">
    </div>
    <div class="card-body text-dark">
      <h3 class="text-center">{{$dates}}</h3>
      <h5 class="card-title">{{ $name }}</h5>
      <p class="card-text formatted lanker-ellipsis">{!! $description !!}</p>
    </div>
    <div class="border-bottom"></div>
    <div class="card-body text-dark">
      <a href="{{ route('event', $name) }}" class="btn btn-primary float-right px-3"><i class="fa fa-arrow-right"></i></a>
      {{-- <p class="card-text"><small class="text-muted">Created on {{ $created_at }}</small></p> --}}
    </div>
  </div>
</div>
