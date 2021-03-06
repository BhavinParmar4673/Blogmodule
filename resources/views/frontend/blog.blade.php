@extends('frontend.master')
@section('title', 'Blog Page')
@section('content')


    <section class="home_banner_area1">
        <div class="banner_blog_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_blog_content text-center">
                    <h2 class="text-uppercase display-4 text-white">Our Blog</h2>
                    <div class="page_link">
                        <a href="{{ URL('/') }}" class="text-white">Home</a>
                        <span class="ti-angle-right text-white"></span>
                        <a href="{{ route('post') }}" class="text-white">Blog</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 my-lg-5">
                    <div class="blog_deatils my-5">
                        @foreach ($posts as $post)
                            <div class="card mb-5 h-100">
                                <img class="img-fluid" src="{{ $post->image_src }}" alt="Card image cap">
                                {{-- <div class="date">
                                                <h2>{{$post->created_at->format('D')}}</h2>
                                                <p>{{$post->created_at->format('M')}}</p>
                                        </div> --}}
                                <div class="card-body my-4">
                                    <a class="post-link" href="{{ route('post.show', $post->slug) }}">
                                        <h2 class="card-title h3">{{ $post->title }}</h2>
                                    </a>
                                    <p class="card-text">{{ $post->description }}</p>
                                    <p class="card-text"><span class="ti-user pr-2 text-muted"></span>
                                        @foreach ($post->tags as $tag)
                                            <a href="#" class="tag_link">
                                                {{ $tag->name }}
                                            </a>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $posts->links('vendor.pagination.blogpagination') }}
                </div>

                <div class="col-lg-4 my-5">
                    <div class="blog_right_sidebar my-5">
                        <div class="category">
                            <aside>
                                <div class="card-body">
                                    <h4 class="widget-title mb-4">Category</h4>
                                    <div class="category-desc">
                                        @foreach ($categorys as $category)
                                            <p class="card-text text-muted">{{ $category->name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </aside>
                        </div>
                        <div class="recent_post">
                            <aside>
                                <div class="card-body">
                                    <h4 class="widget-title mb-4">Recent Post</h4>
                                    @foreach ($blogs as $key => $blogpost)
                                        <div class="row">
                                            <div class="col-md-12 pt-2">
                                                <div class="post_details">
                                                    <div class="post_image d-flex">
                                                        <img class="img-fluid" src="{{ $blogpost->image_src }}"
                                                            alt="no-image">
                                                        <div class="post_description p-3">
                                                            <a href="{{ route('post.show', $blogpost->slug) }}">
                                                                <h3 class="card-title">{{ $blogpost->title }}</h3>
                                                            </a>
                                                            <p class="card-text text-muted h6">
                                                                {{ $blogpost->created_at->format('H') }} Hours Ago</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </aside>
                        </div>
                        <div class="newsletter">
                            <aside>
                                <div class="card-body">
                                    <h4 class="widget-title mb-4">Newsletter</h4>
                                    <form action="{{ route('newsletter.store') }}" name="form" method="POST">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Enter email"
                                                aria-label="Recipient's username" required name="email">
                                        </div>
                                        <div class="work_button">
                                            <button type="submit" class="primary_btn btn-block">SUBSCRIBE</a>
                                        </div>
                                    </form>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>




@endsection
