@extends('frontend.master')
@section('title', 'Home Page')
@section('content')

    <section class="home_banner_area" id="home">
        <div class="banner_inner">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="banner_area col-lg-6 col-md-6">
                        <div class="banner_content">
                            <h4 class="text-uppercase text-muted">Hey There !</h4>
                            <h1 class="text-uppercase display-4 py-2">I am jo Breed</h1>
                            <h5 class="text-uppercase h4">Creative Art Director & Designer</h5>
                            <div class="social_icons my-4">
                                <a href="#">
                                    <span class="ti-twitter mr-2"></span>
                                </a>
                                <a href="#">
                                    <span class="ti-skype mx-2"></span>
                                </a>
                                <a href="#">
                                    <span class="ti-instagram mx-2"></span>
                                </a>
                                <a href="#">
                                    <span class="ti-dribbble mx-2"></span>
                                </a>
                                <a href="#">
                                    <span class="ti-vimeo-alt mx-2"></span>
                                </a>
                            </div>
                            <div class="work_button">
                                <a href="#" class="primary_btn">SEE MY WORK</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="home_right_img">
                            <img class="img-responsive" src="{{ asset('/Image/banner/Programming-amico.svg') }}"
                                alt="animation Image">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- <div class="visit_customer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 col-lg-2">
                    <div class="count py-4">
                        <h2>15K+</h2>
                        <p class="lead">Happy Customer</p>
                    </div>
                </div>
                <div class="col-md-3 col-lg-2">
                    <div class="count py-4">
                        <h2>12K+</h2>
                        <p class="lead">Ticket Solved</p>
                    </div>
                </div>
                <div class="col-md-3 col-lg-2">
                    <div class="count py-4">
                        <h2>9/10</h2>
                        <p class="lead">Average Rating</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container my-5" id="about">
        <div class="main-div row">
            <div class="col-md-6 col-lg-6">
                <div class="creative">
                    <img class="img-fluid" src="{{ asset('Image/xabout-us.png.pagespeed.ic.rJsKCAQgpR.png') }}"
                        alt="no-image">
                </div>
            </div>
            <div class="col-md-6 col-lg-6 p-4 px-lg-5">
                <h5 class="text-muted">ABOUT ME</h5>
                <h1 class="heading-1 font-weight-bold">Creative Art Director<br> And Designer</h1>
                <p class="text-muted my-5">It is a long established fact that a reader will be distracted by the readable
                    content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a
                    more-or-less normal distribution of letters, as opposed to using 'Content here, content here',
                    making it look like readable English. Many desktop publishing packages and web page editors
                    now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will
                    uncover many web sites still in their infancy. Various versions have evolved over the
                    years, sometimes by accident, sometimes on purpose (injected humour and the like).
                </p>
                <div class="work_button">
                    <a href="#" class="primary_btn">DOWNLOAD CV</a>
                </div>
            </div>
        </div>
    </div>

    <div class="our_service mt-5" id="service">
        <div class="container">
            <h5 class="text-muted pb-1">OUR SERVICE</h5>
            <h1 class="heading-1 font-weight-bold">What Service We<br> Offer For You</h1>
            <div class="row my-5">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="service">
                        <img src="{{ asset('Image/services/xs1.png.pagespeed.ic.nbA0t3ngy9.png') }}" alt="no-image"
                            class="img-fluid py-4">
                        <h2 class="headings">Web Devlopment</h2>
                        <p class="text-justify py-3">It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it
                            has a more-or-less normal distribution of letters, as opposed to using 'Content here, content
                            here',
                            making it look like readable English.</p>
                        <a href="" class="service_link">LEARN MORE</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="service">
                        <img src="{{ asset('Image/services/xs2.png.pagespeed.ic.s3FSVmykhX.png') }}" alt="no-image"
                            class="img-fluid py-4">
                        <h2 class="headings">UX/UI Design</h2>
                        <p class="py-3">It is a long established fact that a reader will be distracted by the
                            readable
                            content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a
                            more-or-less normal distribution of letters, as opposed to using 'Content here, content here',
                            making it look like readable English.</p>
                        <a href="" class="service_link">LEARN MORE</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="service">
                        <img src="{{ asset('Image/services/xs3.png.pagespeed.ic.riHq1rrFHN.png') }}" alt="no-image"
                            class="img-fluid py-4">
                        <h2 class="headings">WP Devloping</h2>
                        <p class="text-justify py-3">It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it
                            has a more-or-less normal distribution of letters, as opposed to using 'Content here, content
                            here',
                            making it look like readable English.</p>
                        <a href="" class="service_link">LEARN MORE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="testimonial mt-5" id="testimonial">
        <div class="container">
            <h5 class="text-muted pb-1">OUR TESTIMONIAL</h5>
            <h1 class="heading-1 font-weight-bold">Honourable Client Says<br> About Me</h1>
            <div class="row my-5">
                <div class="col-md-12">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        @php
                            $testimonial = App\Models\Testimonial::where('visibility', 1)
                                ->latest()
                                ->get();
                        @endphp
                        <!-- Carousel indicators -->
                        <ol class="carousel-indicators">
                            @foreach ($testimonial as $record)
                                <li data-target="#myCarousel" data-slide-to="{{ $loop->index }}"
                                    class="{{ $loop->first ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            @foreach ($testimonial as $record)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="img-box"><img src="{{ $record->image_src }}" alt=""></div>
                                    <p class="text-dark h5 my-2">{{ strip_tags($record->content) }}</p>
                                    <p class="overview"><b>{{ $record->member->fullname }}</b>,
                                        {{ $record->member->designation }}</p>
                                </div>
                            @endforeach
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="portfolio mt-5" id="portfolio">
        <div class="container">
            <h5 class="text-muted pb-1">OUR PORTFOLIO</h5>
            <h1 class="heading-1 font-weight-bold">Check Our Recent<br> Client Work</h1>
            @php

                $projects = App\Models\Project::latest()
                    ->take(8)
                    ->get();
            @endphp
            <div class="row py-4">
                @foreach ($projects as $key => $myproject)
                    @if ($key >= 0 && $key < 2)
                        <div class="col-lg-6 col-12 mb-4">
                            <div class="portfolio-item">
                                <a class="portfolio-link" href="{{ route('admin.projects.show', $myproject->id) }}">
                                    <div class="thumbnail">
                                        @foreach ($myproject->project_images as $image)
                                            <img class="img-fluid" src="{{ $image->image_src }}" alt="..." />
                                        @endforeach
                                    </div>
                                    <div class="portfolio-hover">
                                        <h2 class="work__title">{{ $myproject->title }}</h2>
                                        <p class="work__desc">{{ Str::limit($myproject->description, 35) }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($key >= 2 && $key < 5)
                        <div class="col-lg-4 col-12 mb-4">
                            <div class="portfolio-item">
                                <a class="portfolio-link" href="{{ route('admin.projects.show', $myproject->id) }}">
                                    <div class="thumbnail">
                                        @foreach ($myproject->project_images as $image)
                                            <img class="img-fluid" src="{{ $image->image_src }}" alt="..." />
                                        @endforeach
                                    </div>
                                    <div class="portfolio-hover">
                                        <h2 class="work__title">{{ $myproject->title }}</h2>
                                        <p class="work__desc">{{ Str::limit($myproject->description, 35) }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($key >= 5 && $key < 8)
                        <div class="col-lg-3 col-12 mb-4">
                            <div class="portfolio-item">
                                <a class="portfolio-link" href="{{ route('admin.projects.show', $myproject->id) }}">
                                    <div class="thumbnail">
                                        @foreach ($myproject->project_images as $image)
                                            <img class="img-fluid" src="{{ $image->image_src }}" alt="..." />
                                        @endforeach
                                    </div>
                                    <div class="portfolio-hover">
                                        <h2 class="work__title">{{ $myproject->title }}</h2>
                                        <p class="work__desc">{{ Str::limit($myproject->description, 35) }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="col-lg-3 col-12 mb-4">
                    <div class="portfolio-item">
                        <a class="portfolio-link button_link" href="{{ route('project') }}">
                            <div class="thumbnail">
                                <h2>View More<span class="float-right ti-arrow-right"></h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
    $blogs = App\Models\Post::latest()
        ->take(3)
        ->get();
    @endphp
    <div class="blog mt-5" id="blog">
        <div class="container">
            <h5 class="text-muted pb-1">OUR BLOG</h5>
            <h1 class="heading-1 font-weight-bold">Latest Story From<br> Our Blog</h1>
            <div class="row mt-4">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6 py-2">
                        <div class="card h-100">
                            <img class="img-fluid" src="{{ $blog->image_src }}" alt="Card image cap">
                            <div class="card-body">
                                <div class="d-flex justify-content-between pb-2">
                                    <a href="#" class="blog_link"><span
                                            class="ti-user pr-2"></span>{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : 'Admin' }}</a>
                                    <a href="#" class="blog_link"><span
                                            class="ti-calendar pr-2"></span>{{ $blog->updated_at->toDateString() }}</a>
                                </div>
                                <a href="#" class="blog_link">
                                    <h5 class="card-title">{{ $blog->title }}</h5>
                                </a>
                                <p class="card-text">{{ $blog->description }}</p>
                                <a href="" class="blog_link_design">LEARN MORE</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="brands my-5" id="brand">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        <div class="item px-3">
                            <img class="img-fluid"
                                src="{{ asset('Image/brands/xlogo1.png.pagespeed.ic.zYTo7zZjjz.png') }}" alt="">
                        </div>
                        <div class="item px-3">
                            <img class="img-fluid"
                                src="{{ asset('Image/brands/xlogo2.png.pagespeed.ic.Z25wYds54V.png') }}" alt="">
                        </div>
                        <div class="item px-3">
                            <img class="img-fluid"
                                src="{{ asset('Image/brands/xlogo3.png.pagespeed.ic.B7WJK2eRsf.png') }}" alt="">
                        </div>
                        <div class="item px-3">
                            <img class="img-fluid"
                                src="{{ asset('Image/brands/xlogo4.png.pagespeed.ic.wyij8nrzlO.png') }}" alt="">
                        </div>
                        <div class="item px-3">
                            <img class="img-fluid"
                                src="{{ asset('Image/brands/xlogo5.png.pagespeed.ic.HC2c65JSLR.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
