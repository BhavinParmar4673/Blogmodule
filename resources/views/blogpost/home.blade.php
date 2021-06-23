@extends('layouts.master')
@section('content')
<div class="clearfix mx-3">
    <h2 class="float-left">List of all Posts</h2>

    {{-- link to create new post --}}
    <a href="{{ route('blogs.create') }}" class="btn btn-primary float-right">Create new post</a>
</div>

@if (session('message'))
    <div class="alert alert-success mx-2">
        {{ session('message') }}
    </div>
@endif

{{-- List all posts --}}
@forelse ($blog as $post)
    <div class="card m-2 shadow-sm">
        <div class="card-body">

            {{-- post title --}}
            <h4 class="card-title">
                <a href="{{ route('blogs.show', $post->id) }}">{{ $post->title }}</a>
            </h4>
            <p class="card-text">
                {{-- post owner --}}
                <small class="float-left">By: {{ $post->user->name }}</small>

                {{-- creation time --}}
                <small class="float-right text-muted">{{ $post->created_at->format('M d, Y h:i A') }}</small>
                
                {{-- check if the signed-in user is the post owner, then show edit post link --}}
                @if (auth()->id() == $post->user->id )
                    {{-- edit post link --}}
                    <small class="float-right mr-2 ml-2">
                        <a href="{{ route('blogs.edit', $post->id) }}" class="float-right">edit your post</a>
                    </small>
                @endif
            </p>
        </div>
    </div>
@empty
    <p>No posts yet, stay tuned!</p>
@endforelse



@endsection