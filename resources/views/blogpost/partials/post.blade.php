<div class="card shadow">
    <div class="card-body">
        {{-- Post title  --}}
      <h4 class="card-title">
          {{ $blog->title }}
      </h4>
  
      {{-- Owner name with created_at --}}
      <small class="text-muted float-right">
          Posted by: <b>{{ $blog->user->name }}</b> <span class="ml-2">{{ $blog->created_at->format('M d, Y H:i:s') }}</span>
      </small>

  
      {{-- Post body --}}
      <p class="card-text">
          {{ $blog->body }}
      </p>
      <p class="text-">
        <span class="text-bold">Category</span> : {{$blog->category->name}}
      </p>
      <p class="text-bold">
        <span class="text-bold">Project</span> : {{$blog->project->title}}
      </p>
  
      {{-- include all comments related to this post --}}
      <hr>
      @include('blogpost.partials.comments')
    </div>
  </div>
  
  