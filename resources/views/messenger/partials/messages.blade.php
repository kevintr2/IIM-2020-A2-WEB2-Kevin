<div class="media">
    <a class="profilpicture pull-left" href="{{route('users.show', $message->user->id)}}">
        @if(Storage::disk('uploads')->has($message->user->image))
            <img src="{{route('articles.image', ['filename'=> $message->user->image])}}" alt="img"
                 class="img-responsive">
        @else
        @endif
        @if(!Storage::disk('uploads')->has($message->user->image))
            <img src="{{ $message->user->image }}" alt="img" class="img-responsive">
        @endif
    </a>
    <div class="media-body">
        <a href="{{ route('users.show', $message->user->id) }}"><h4 class="media-heading"><b>{{ $message->user->name }}</b></h4></a>
        <p>{{ $message->body }}</p>
        <div class="text-muted">
            <small>Posted {{ $message->created_at->diffForHumans() }}</small>
        </div>
</div>
</div>