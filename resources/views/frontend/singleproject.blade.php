@extends('frontend.master')
@section('title', 'single project')
@section('content')

    <section class="project py-lg-5 py-sm-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-9 col-lg-9">
                    <div class="card mb-5 h-100">
                        @foreach ($project->project_images as $image)
                            <img class="img-fluid" src="{{ $image->image_src }}" alt="Card image cap">
                        @endforeach
                        <div class="card-body mt-4">
                            <h2 class="card-title h3">{{ $project->title }}</h2>
                            <p class="card-text">{{ $project->description }}</p>
                            <p class="card-text"><span class="ti-user pr-2 text-muted"></span>
                                @foreach ($project->tags as $tag)
                                    <a href="#" class="tag_link">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
