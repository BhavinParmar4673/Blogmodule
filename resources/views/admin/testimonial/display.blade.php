@extends('admin.layouts.master')
@section('title', 'Testimonial')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <style>
        .gtco-testimonials {
            position: relative;
            margin-top: 30px;
        }

        h2 {
            font-size: 30px;
            color: #333333;
            margin-bottom: 25px;
        }

        .owl-stage-outer {
            padding: 30px 0;
        }

        .owl-nav {
            display: none;
        }

        .owl-dots {
            text-align: center;

            span {
                position: relative;
                height: 10px;
                width: 10px;
                border-radius: 50%;
                display: block;
                background: #fff;
                border: 2px solid #01b0f8;
                margin: 0 5px;
            }

            .active {
                box-shadow: none;

                span {
                    background: #01b0f8;
                    box-shadow: none;
                    height: 12px;
                    width: 12px;
                    margin-bottom: -1px;
                }
            }
        }

        .card {
            background: #fff;
            box-shadow: 0 8px 30px -7px #c9dff0;
            margin: 0 20px;
            padding: 0 10px;
            border-radius: 20px;
            border: 0;
        }

        .card-img-top {
            max-width: 100px;
            border-radius: 50%;
            margin: 15px auto 0;
            box-shadow: 0 8px 20px -4px #95abbb;
            width: 100px;
            height: 100px;
        }

        h5 {
            color: #01b0f8;
            font-size: 21px;
            line-height: 1.3;

            span {
                font-size: 18px;
                color: #666666;
            }


            p {
                font-size: 18px;
                color: #555;
                padding-bottom: 15px;
            }
        }

        .active {
            /* opacity: 0.9; */
            transition: all 0.3s;
        }

        .center {
            opacity: 1;

            h5 {
                font-size: 24px;

                span {
                    font-size: 20px;
                }
            }

            .card-img-top {
                max-width: 100%;
                height: 120px;
                width: 120px;
            }
        }
        }

        @media (max-width: 767px) {
            .gtco-testimonials {
                margin-top: 20px;
            }
        }

        .owl-carousel {
            .owl-nav button {

                &.owl-next,
                &.owl-prev {
                    outline: 0;
                }
            }

            button.owl-dot {
                outline: 0;
            }
        }

    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All Testimonial</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.display') }}">All Client Testimonial</a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="gtco-testimonials">
                    <h2>Testimonials Carousel - Cards Comments</h2>
                    <div class="owl-carousel owl-carousel1 owl-theme">
                        @foreach ($testimonial as $record)
                            <div>
                                <div class="card text-center"><img class="card-img-top"
                                        src="{{ $record->image_src }}?crop=entropy&cxid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=50&w=300"
                                        alt="">
                                    <div class="card-body">
                                        <h5>{{ $record->member->fullname }} <br />
                                            <span class="text-success">{{ $record->member->designation }} </span>
                                        </h5>
                                        <p class="card-text">“ {{ strip_tags($record->content) }} ” </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->








    @push('script')
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $(".owl-carousel1").owlCarousel({
                    loop: true,
                    center: true,
                    margin: 0,
                    responsiveClass: true,
                    nav: false,
                    responsive: {
                        0: {
                            items: 1,
                            nav: false
                        },
                        680: {
                            items: 2,
                            nav: false,
                            loop: false
                        },
                        1000: {
                            items: 3,
                            nav: true
                        }
                    }
                });


            });
        </script>
    @endpush

@endsection
