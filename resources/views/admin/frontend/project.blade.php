@extends('admin.frontend.master')
@section('title', 'All Project')
@section('content')

<div class="portfolio_filter py-5" id="portfolio">
    <div class="container py-5">
        <h5 class="text-muted pb-2">OUR PORTFOLIO</h5>
        <h1 class="heading-1 font-weight-bold">Check Our Recent<br> Client Work</h1>
        <ul class="pt-5">
            <li class="list active" data-filter="all">All</li>
            @foreach ($tags as $tag)
                 <li class="list" data-filter="{{$tag->name}}" data-id="{{$tag->id}}">{{$tag->name}}</li>
            @endforeach

            <a href="javascript:void(0)" id="filter" data-url="{{ route('admin.filter') }}"></a>
        </ul>
        <div class="row my-5">
            @foreach ($projects as $key => $myproject)
                    <div class="col-lg-6 col-sm-12 mb-4">
                      <div class="itembox all">
                            <div class="portfolio-item">
                                <a class="portfolio-link" href="{{route('admin.projects.show',$myproject->id)}}">
                                <div class="thumbnail">
                                    @foreach ($myproject->project_images as $image)
                                        <img class="img-fluid" src="{{ $image->image_src }}" alt="..." />
                                    @endforeach
                                </div>
                                </a>
                            </div>
                            <div class="portfolio-details mt-4">
                                <h2 class="work__title">{{ $myproject->title }}</h2>
                                <p class="text-muted">{{ $myproject->description }}</p>
                            </div>
                      </div>
                    </div>
            @endforeach
        </div>
        <div class="row" id="itembox-dynamic">
        </div>
    </div>
</div>
@endsection