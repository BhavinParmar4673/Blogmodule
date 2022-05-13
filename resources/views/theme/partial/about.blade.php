<section class="p-0 page d-none" id="about">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-9 order-1 order-lg-0 pt-10 pt-lg-8 pt-xl-7 pt-xxl-8 pb-0 px-lg-0">
                <div class="row flex-center" id="bigpicture">
                    <div class="col-11 col-xl-7">

                        <div class="text-center mb-5 mb-lg-6">
                            <h2><span class="fw-medium">The Story of </span> Boots5</h2>
                        </div>
                        <div class="position-relative"> <img class="img-fluid rounded-3"
                                src="{{ asset('theme/assets/img/rainbow.png') }}" alt="..." /><a
                                class="player" href="#!" data-bigpicture='{"ytSrc":"{{ $about->file_src }}"}'>
                                <img src="{{ asset('theme/assets/img/player.png') }}" alt="..." /></a></div>
                        <h3 class="pb-4 pt-5">{{ $about->heading ?? '' }}</h3>
                        <p class="text-1000 fs-1">
                            {!! $about->content !!}
                        </p>
                        <div class="row justify-content-center pt-6 g-2">
                            <div class="text-center mb-5 mb-lg-6">
                                <h2 class="fs-2 fs-sm-3"> <span class="fw-medium">Meet &nbsp;</span>Our
                                    Team</h2>
                            </div>
                            <div class="col-lg-11 col-xxl-9">
                                <div class="row justify-content-center">
                                    @foreach ($employees as $key => $employee)
                                        <div class="col-6 mb-5 {{ $key > 1 ? 'col-sm-4 col-auto' : '' }}">
                                            <div class="position-relative d-flex flex-center flex-column"><img
                                                    class="img-fluid rounded-circle"
                                                    src="{{ $employee->profile ?? '' }}"
                                                    width="{{ $key > 1 ? '133' : '242' }}" alt="" />
                                                <h5 class="fw-bold mt-3 mb-1">{{ $employee->name ?? '' }}</h5>
                                                <h5 class="fw-normal text-800 mb-1">
                                                    {{ $employee->designation ?? '' }}</h5><a class="stretched-link"
                                                    href="#!"></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center pt-3d">
                    <div class="col-lg-8 col-xl-7 mb-n5 mb-md-n8 mb-lg-n6 mb-xl-n9 mt-8">
                        <div class="card bg-backdrop">
                            <div class="card-body p-2 px-lg-2 px-xl-5">
                                <div class="py-5 text-center">
                                    <h2 class="fs-1 fs-xxl-2 fw-bolder">Start your next project with us</h2>
                                    <p class="mb-4 text-900">Join the talented group of artists and
                                        imaginators</p><a class="btn hover-top btn-boots-warning" href="#!">Join Boots5
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10"><img class="w-100"
                            src="{{ asset('theme/assets/img/cta/cta-about.png') }}" alt="..."
                            style="border-radius:1rem;" /></div>
                </div>
                <div class="row justify-content-center my-3">
                    <div class="col-12 col-lg-10">
                        <div class="card bg-soft-blue">
                            <div class="card-body py-3">
                                <div class="row">
                                    <div class="col-lg-6 text-center text-lg-start">
                                        <p class="fs--1 my-2 fw-bold text-gradient-blue-soft">All rights
                                            Reserved &copy; Your Company, 2021</p>
                                    </div>
                                    <div class="col-lg-6 d-lg-flex align-self-center justify-content-end text-center">
                                        <p class="fs--1 mb-0 text-gradient-blue-soft">Made with <span
                                                class="fas fa-heart mx-1 text-primary"></span>by<a
                                                href="https://themewagon.com/"> Themewagon</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 position-absolute position-lg-relative ps-lg-0">
                <div class="sticky-top py-4 sticky-area" data-sidebar-close="sidebar-close">
                    <div class="btn-close-boots-container times">
                        <div class="btn-close-boots"></div>
                    </div>
                    <div class="bg-holder sidebar-rounded"
                        style="background-image:url('{{ asset('theme/assets/img/sidebars/about.png') }}');">
                    </div>
                    <!--/.bg-holder-->
                    <div
                        class="position-relative d-lg-flex flex-column justify-content-end align-items-end h-100 px-lg-4 px-xxl-5">
                        <h1 class="text-white text-vertical px-5 px-lg-0 opacity-50 fs-xl-3 fs-xxl-4">About Us
                        </h1><img class="d-none d-lg-block line-icons mt-5"
                            src="{{ asset('theme/assets/img/lineicons/diamond.png') }}" alt="icon" />
                        <hr class="my-4 w-100 d-none d-lg-block opacity-25" />
                        <div class="flex-between-center d-none d-lg-flex w-100 opacity-75"
                            data-sidebar-link="page-link"><a class="sidebar-nav btn btn-link text-decoration-none px-1"
                                href="#portfolio">
                                <i class="fas fa-chevron-left me-lg-2 me-xl-2 me-xxl-4"></i><span
                                    class="text-capitalize">portfolio</span></a><a
                                class="sidebar-nav btn btn-link text-decoration-none px-1" href="#services"><span
                                    class="text-capitalize">services</span><i
                                    class="fas fa-chevron-right ms-lg-2 ms-xl-2 ms-xxl-4"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of .container-->
</section>
