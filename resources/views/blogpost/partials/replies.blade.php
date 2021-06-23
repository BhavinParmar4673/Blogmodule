{{-- list all replies for a comment --}}
@foreach ($comment->replies as $reply)
    
  <div class="ml-4 card-text">
		<b>{{ $reply->user->name }}</b> replied
		<small class="text-muted float">{{ $reply->created_at->diffForHumans() }}</small>
		<p>{{ $reply->body }}</p>
  </div>

@endforeach