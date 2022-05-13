<!DOCTYPE html>
<html lang="en-US" dir="ltr">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>{{ config('app.name', 'Laravel') }} | {{ ucfirst($title) }}</title>
    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('theme/assets/img/favicons/apple-touch-icon.html') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $setting->favicon ?? '' }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $setting->favicon ?? '' }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $setting->favicon ?? '' }}">
    <link rel="manifest" href="{{ asset('theme/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('theme/assets/img/favicons/mstile-150x150.html') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('theme/vendors/prism/prism.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/assets/css/theme.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/assets/css/user.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    {{ $link ?? '' }}
    {{ $css ?? '' }}
    {{ $style ?? '' }}
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

        <!-- ============================================-->
        <!-- Preloader ==================================-->
        <div class="preloader" id="preloader">
            <div class="loader"><span> </span><span></span><span></span><span></span><span> </span></div>
        </div><!-- ============================================-->
        <!-- End of Preloader ===========================-->
        <div class="offcanvas offcanvas-start home-content show" id="offcanvasStart" tabindex="-1"
            data-bs-backdrop="false" data-bs-scroll="true" data-base-content="home">
            <div class="offcanvas-body d-flex flex-column flex-center"><a class="text-center" href="index.html"><img
                        class="mb-3 logo" src="{{ $setting->logo ?? '' }}" alt="logo"></a>
                <p class="text-center mb-5">{{ $response->content ?? '' }}</p>
                <ul class="list-inline">
                    <li class="list-inline-item"><a class="text-700 mx-2" href="{{ $response->facebook ?? '' }}">
                            <span class="fab fa-facebook"></span></a></li>
                    <li class="list-inline-item"><a class="text-700 mx-2" href="{{ $response->linkedin ?? '' }}">
                            <span class="fab fa-linkedin"></span></a></li>
                    <li class="list-inline-item"><a class="text-700 mx-2" href="{{ $response->instagram ?? '' }}">
                            <span class="fab fa-instagram"></span></a></li>
                    <li class="list-inline-item"><a class="text-700 mx-2" href="{{ $response->whatsapp ?? '' }}">
                            <span class="fab fa-whatsapp"></span></a></li>
                </ul>
            </div>
        </div>


        <div class="offcanvas offcanvas-end home-nav px-0 show" id="offcanvasEnd" tabindex="-1" data-bs-backdrop="false"
            data-bs-scroll="true" data-base-content="nav">
            <div class="offcanvas-body p-0 position-lg-fixed position-relative">
                <div class="row vh-lg-100 g-0 bg-100">
                    <div class="col-6 home-nav-items position-relative text-white nav-hover-zoom nav-blue-soft"><img
                            class="nav-img" src="{{ asset('theme/assets/img/navigation/about-4-2.png') }}"
                            alt="..." />
                        <div
                            class="card-img-overlay d-flex flex-column flex-center align-items-xxl-start justify-content-xxl-end h-100 pb-4 px-5">
                            <div class="mb-3"> <img class="nav-icons"
                                    src="{{ asset('theme/assets/img/lineicons/diamond-4-2.png') }}" alt="icon" />
                            </div>
                            <a class="text-light fs-1 fs-xl-2 fs-xxl-3 stretched-link items fw-bold text-decoration-none"
                                href="#about">About</a>
                        </div>
                    </div>
                    <div class="col-6 home-nav-items position-relative text-white nav-hover-zoom nav-red-soft"><img
                            class="nav-img" src="{{ asset('theme/assets/img/navigation/services-4-2.png') }}"
                            alt="..." />
                        <div
                            class="card-img-overlay d-flex flex-column flex-center align-items-xxl-start justify-content-xxl-end h-100 pb-4 px-5">
                            <div class="mb-3"> <img class="nav-icons"
                                    src="{{ asset('theme/assets/img/lineicons/thunder-4-2.png') }}" alt="icon" />
                            </div><a
                                class="text-light fs-1 fs-xl-2 fs-xxl-3 stretched-link items fw-bold text-decoration-none"
                                href="#services">Services</a>
                        </div>
                    </div>
                    <div class="col-6 home-nav-items position-relative text-white nav-hover-zoom nav-yellow-soft"><img
                            class="nav-img" src="{{ asset('theme/assets/img/navigation/contact-4-2.png') }}"
                            alt="..." />
                        <div
                            class="card-img-overlay d-flex flex-column flex-center align-items-xxl-start justify-content-xxl-end h-100 pb-4 px-5">
                            <div class="mb-3"> <img class="nav-icons"
                                    src="{{ asset('theme/assets/img/lineicons/map-4-2.png') }}" alt="icon" /></div><a
                                class="text-light fs-1 fs-xl-2 fs-xxl-3 stretched-link items fw-bold text-decoration-none"
                                href="#contact">Contact</a>
                        </div>
                    </div>
                    <div class="col-6 home-nav-items position-relative text-white nav-hover-zoom nav-purple-soft"><img
                            class="nav-img" src="{{ asset('theme/assets/img/navigation/portfolio-4-2.png') }}"
                            alt="..." />
                        <div
                            class="card-img-overlay d-flex flex-column flex-center align-items-xxl-start justify-content-xxl-end h-100 pb-4 px-5">
                            <div class="mb-3"> <img class="nav-icons"
                                    src="{{ asset('theme/assets/img/lineicons/trophy-4-2.png') }}" alt="icon" />
                            </div><a
                                class="text-light fs-1 fs-xl-2 fs-xxl-3 stretched-link items fw-bold text-decoration-none"
                                href="#portfolio">Portfolio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ $slot ?? '' }}

    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    <div id="load-modal"></div>

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset('theme/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/polyfill.min58be.js?features=window.scroll') }}"></script>
    <script src="{{ asset('theme/vendors/imagesloaded/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('theme/vendors/prism/prism.js') }}"></script>
    <script src="{{ asset('theme/assets/js/smtp.js') }}"></script>
    <script src="{{ asset('theme/assets/js/theme.js') }}"></script>
    <script
        src="{{ asset('theme/assets/js/polyfill.min85ed.js?features=es6,Array.prototype.includes,CustomEvent,Object.entries,Object.values,URL') }}">
    </script>
    <script src="{{ asset('theme/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/isotope-packery/packery-mode.pkgd.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAoW9gqubJ7lFhWEMoTJPgtpsCSdU8gjs&amp;callback=initMap"
        async></script>
    <script src="{{ asset('theme/vendors/countup/countUp.umd.js') }}"></script>
    <script src="{{ asset('theme/vendors/bigpicture/BigPicture.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    {{ $script ?? '' }}
    {{ $javascript ?? '' }}

</body>

</html>
