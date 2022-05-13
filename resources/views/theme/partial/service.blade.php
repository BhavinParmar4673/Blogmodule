<section class="p-0 page d-none" id="services">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-xl-9 order-1 order-lg-0 pt-8 pt-lg-0 pb-0 px-lg-0">
                <div class="row min-vh-25 flex-center">
                    <div class="col-lg-10">
                        <div class="card card-span">
                            <div class="bg-holder bg-size"
                                style="background-image:url('{{ asset('theme/assets/img/services/services-card-bg.png') }}');background-position:top center;background-size:cover;border-end-end-radius:5.5rem;border-end-start-radius:5.5rem;">
                            </div>
                            <!--/.bg-holder-->
                            <div class="card-body position-relative">
                                <div class="text-center my-3">
                                    <h2 class="fs-1 fs-md-2 fs-lg-3">What We Do Best</h2>
                                    <div class="row flex-center">
                                        @forelse ($services as $key=>$service)
                                            <div class="col-xl-9 col-xxl-8 my-6">
                                                <div class="d-sm-flex flex-center">
                                                    <img class="{{ $key % 2 == 0 ? 'order-0' : 'order-1' }} pe-4"
                                                        src="{{ $service->image_src }}" alt="services" />
                                                    <div class="flex-1 text-center text-sm-start">
                                                        <h3 class="mb-3 fw-bolder text-gradient-orange-1">
                                                            {{ $service->$title ?? '' }}</h3>
                                                        <p class="mb-0 text-1200">{{ $service->description ?? '' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-xl-9 col-xxl-8 my-6">
                                                <div class="d-sm-flex flex-center">
                                                    <h2>Currently service Not Found</h2>
                                                </div>
                                            </div>
                                        @endforelse
                                        {{-- <div class="col-xl-9 col-xxl-8 my-6">
                                            <div class="d-sm-flex flex-center"><img class="order-0 pe-4"
                                                    src="{{ asset('theme/assets/img/services/development.png') }}"
                                                    alt="services" />
                                                <div class="flex-1 text-center text-sm-start">
                                                    <h3 class="mb-3 fw-bolder text-gradient-orange-1">
                                                        Development</h3>
                                                    <p class="mb-0 text-1200">Our award-winning team follow
                                                        industry best practices to develop software.</p>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row py-7 justify-content-center">
                            <h2 class="mb-4 text-center"><span class="fw-medium">Choose </span>Your Plan
                            </h2>
                            <div class="col-sm-6 col-xl-4 pt-4 px-md-2">
                                <div class="card card-span h-100 bg-white" style="border-radius:1rem;">
                                    <div class="card-body d-flex flex-column justify-content-around px-xl-4 px-xxl-5">
                                        <div class="text-center">
                                            <h2 class="fs-lg-2 fx-xxl-4 text-800 my-3">Basic</h2>
                                            <h2 class="mb-3 fs-lg-2 fs-xxl-4 text-gradient-blue">$20<span
                                                    class="text-gradient-gray fs-1">/ monthly</span></h2>
                                        </div>
                                        <ul class="list-unstyled my-4 ps-5 ps-lg-0 ps-xl-2 ps-xxl-5">
                                            <li class="mb-3"><span class="me-2"><i
                                                        class="fas fa-check-circle"></i></span>Unlimited </li>
                                            <li class="mb-3"><span class="me-2"><i
                                                        class="fas fa-check-circle"></i></span>Encrypted</li>
                                            <li class="mb-3"><span class="me-2"><i
                                                        class="fas fa-check-circle"></i></span>No Traffic Logs
                                            </li>
                                            <li class="mb-3"><span class="me-2"><i
                                                        class="fas fa-check-circle"></i></span>Works on All
                                            </li>
                                        </ul>
                                        <div class="text-center">
                                            <div class="d-grid"> <button class="btn btn-klean-outline border-0"
                                                    type="submit"> <span
                                                        class="text-gradient-blue">Purchase</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4 pt-4 px-md-2">
                                <div class="card card-span h-100 bg-pricing-gradient" style="border-radius:1rem;">
                                    <div class="card-body d-flex flex-column justify-content-around px-xl-4 px-xxl-5">
                                        <div class="text-center">
                                            <h2 class="fs-lg-2 fx-xxl-4 text-800 my-3">Advanced</h2>
                                            <h2 class="mb-3 fs-lg-2 fs-xxl-4 text-gradient-pink-2">$50<span
                                                    class="text-gradient-gray fs-1">/ monthly</span></h2>
                                        </div>
                                        <ul class="list-unstyled my-4 ps-5 ps-lg-0 ps-xl-2 ps-xxl-5">
                                            <li class="mb-3"><span class="me-2"><i
                                                        class="fas fa-check-circle"></i></span>Unlimited </li>
                                            <li class="mb-3"><span class="me-2"><i
                                                        class="fas fa-check-circle"></i></span>Encrypted</li>
                                            <li class="mb-3"><span class="me-2"><i
                                                        class="fas fa-check-circle"></i></span>Yes Traffic Logs
                                            </li>
                                            <li class="mb-3"><span class="me-2"><i
                                                        class="fas fa-check-circle"></i></span>Works on All
                                            </li>
                                        </ul>
                                        <div class="text-center">
                                            <div class="d-grid"> <button class="btn btn-pricing-danger border-0"
                                                    type="submit">Purchase</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4 pt-4 px-md-2">
                                <div class="card card-span h-100 bg-white" style="border-radius:1rem;">
                                    <div class="card-body d-flex flex-column justify-content-around px-xl-4 px-xxl-5">
                                        <div class="text-center">
                                            <h2 class="fs-lg-2 fx-xxl-4 text-800 my-3">Business</h2>
                                            <h2 class="mb-3 fs-lg-2 fs-xxl-4 text-gradient-blue">$30<span
                                                    class="text-gradient-gray fs-1">/ monthly</span></h2>
                                        </div>
                                        <ul class="list-unstyled my-4 ps-5 ps-lg-0 ps-xl-2 ps-xxl-5">
                                            <li class="mb-3"><span class="me-2"><i
                                                        class="fas fa-check-circle"></i></span>Unlimited </li>
                                            <li class="mb-3"><span class="me-2"><i
                                                        class="fas fa-check-circle"></i></span>Encrypted</li>
                                            <li class="mb-3"><span class="me-2"><i
                                                        class="fas fa-check-circle"></i></span>Yes Traffic Logs
                                            </li>
                                            <li class="mb-3"><span class="me-2"><i
                                                        class="fas fa-check-circle"></i></span>Works on All
                                            </li>
                                        </ul>
                                        <div class="text-center">
                                            <div class="d-grid"> <button
                                                    class="btn btn-klean-outline border-0" type="submit"> <span
                                                        class="text-gradient-blue">Purchase</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row pt-7 flex-center">
                            <div class="col-xl-9">
                                <div class="row">
                                    <h2 class="text-center mb-6"><span class="fw-medium">Our
                                        </span>Valuable Clients</h2>
                                    @forelse ($clients as $key=>$client)
                                        <div class="col-6 col-sm-4 text-center mb-4"><img class="img-fluid"
                                                src="{{ $client->image_src ?? '' }}" alt="..." />
                                        </div>
                                    @empty
                                        <div class="col-6 col-sm-4 text-center mb-4">
                                            <h4>Currently Have No clients</h4>
                                        </div>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row justify-content-center pt-3d">
                            <div class="col-lg-8 col-xl-7 mb-n5 mb-md-n8 mb-lg-n6 mb-xl-n9 mt-8">
                                <div class="card bg-backdrop">
                                    <div class="card-body p-2 px-lg-2 px-xl-5">
                                        <div class="py-5 text-center">
                                            <h2 class="fs-1 fs-xxl-2 fw-bolder">Start your next project with us
                                            </h2>
                                            <p class="mb-4 text-900">Join the talented group of artists and
                                                imaginators</p><a class="btn hover-top btn-boots-purple" href="#!">Join
                                                Boots5 </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10"><img class="w-100"
                                    src="{{ asset('theme/assets/img/cta/cta-services.png') }}" alt="..."
                                    style="border-radius:1rem;" /></div>
                        </div>
                        <div class="row justify-content-center my-3">
                            <div class="col-12 col-lg-10">
                                <div class="card bg-soft-danger">
                                    <div class="card-body py-3">
                                        <div class="row">
                                            <div class="col-lg-6 text-center text-lg-start">
                                                <p class="fs--1 my-2 fw-bold text-gradient-danger-soft">All
                                                    rights Reserved &copy; Your Company, 2021</p>
                                            </div>
                                            <div
                                                class="col-lg-6 d-lg-flex align-self-center justify-content-end text-center">
                                                <p class="fs--1 mb-0 text-gradient-danger-soft">Made with <span
                                                        class="fas fa-heart mx-1 text-danger"></span>by<a
                                                        href="https://themewagon.com/"> Themewagon</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3 col-12 position-absolute position-lg-relative ps-lg-0">
                <div class="sticky-top py-4 sticky-area" data-sidebar-close="sidebar-close">
                    <div class="btn-close-boots-container times">
                        <div class="btn-close-boots"></div>
                    </div>
                    <div class="bg-holder sidebar-rounded"
                        style="background-image:url('{{ asset('theme/assets/img/sidebars/services.png') }}');">
                    </div>
                    <!--/.bg-holder-->
                    <div
                        class="position-relative d-lg-flex flex-column justify-content-end align-items-end h-100 px-lg-4 px-xxl-5">
                        <h1 class="text-white text-vertical px-5 px-lg-0 opacity-50 fs-xl-3 fs-xxl-4">Services
                        </h1><img class="d-none d-lg-block line-icons mt-5"
                            src="{{ asset('theme/assets/img/lineicons/thunder-bolt.png') }}" alt="icon" />
                        <hr class="my-4 w-100 d-none d-lg-block opacity-25" />
                        <div class="flex-between-center d-none d-lg-flex w-100 opacity-75"
                            data-sidebar-link="page-link"><a class="sidebar-nav btn btn-link text-decoration-none px-1"
                                href="#about"> <i class="fas fa-chevron-left me-lg-2 me-xl-2 me-xxl-4"></i><span
                                    class="text-capitalize">about</span></a><a
                                class="sidebar-nav btn btn-link text-decoration-none px-1" href="#contact"><span
                                    class="text-capitalize">contact</span><i
                                    class="fas fa-chevron-right ms-lg-2 ms-xl-2 ms-xxl-4"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of .container-->
</section>
