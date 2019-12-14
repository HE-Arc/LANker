<div class="{{$class??''}}">
  <a href="{{ route('profile', $user->name) }}"> <img src="{{ url('storage/'.$user->avatar) }}" class="lanker-avatar-mini" alt="avatar">{{$user->name}}</a>
</div>
