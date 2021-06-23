<h4 class="card-title">Comments</h4>

{{-- add comment form --}}
@include('blogpost.partials.add_comments')
    
{{-- list all comments --}}
@forelse($blog->comments as $comment)
	<div class="card-text">
		<b>{{ $comment->user->name }}</b> said
		<small class="text-muted">
		    {{ $comment->created_at->diffForHumans() }}
		</small>
		<p>{{ $comment->body }}</p>

		{{-- include add reply form --}}
		@include('blogpost.partials.add_reply')

		{{-- list all replies --}}
		@include('blogpost.partials.replies')
	</div>
	{!! $loop->last ? '' : '<hr>' !!}
@empty
	<p class="card-text">no comments yet!</p>
@endforelse
