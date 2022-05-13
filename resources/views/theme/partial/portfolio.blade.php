<section class="p-0 page d-none" id="portfolio">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-xl-9 order-1 order-lg-0 pt-10 pt-lg-8 pt-xl-7 pt-xxl-8 pb-0">
                <div class="row flex-center">
                    <div class="col-lg-10 col-xl-7">
                        <div class="text-center mb-5 mb-lg-6">
                            <h2><span class="fw-medium">Our</span> Latest Works</h2>
                        </div>
                        <div class="mb-5 sortable" data-filter-nav="data-filter-nav">
                            <ul class="nav menu justify-content-center mb-2" data-filter-nav="data-filter-nav">
                                <li class="nav-item ls">
                                    <div class="isotope-nav px-3 px-lg-2 px-xl-3 text-decoration-none active"
                                        data-filter="*"> <i class="fas fa-th fs-0 me-2"></i>All</div>
                                </li>
                                @foreach ($tags as $key => $list)
                                    <li class="nav-item ls {{ $key == 0 ? 'me-2' : '' }}">
                                        <div class="isotope-nav px-3 px-lg-2 px-xl-3 text-decoration-none"
                                            data-filter=".{{ $list->name }}"> <i
                                                class="{{ $list->icon }} fs-0 me-2 fs-0"></i>{{ $list->name }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="row g-2 mt-2" id="portfolio-gallery" data-isotope='{"layoutMode":"packery"}'>
                            @foreach ($projects as $key => $project)
                                <div class="col-6 masonry-item {{ $project->filter }}">
                                    <div class="card hoverbox overflow-hidden"><img class="img-fluid"
                                            src="{{ $project->image }}" alt="" />
                                        <div class="card-img-overlay">
                                            <div class="px-4 hoverbox-content d-flex flex-column flex-center"><a
                                                    class="stretched-link call-modal"
                                                    href="{{ route('single', $project->id) }}" data-toggle="modal"
                                                    data-url="{{ route('single', $project->id) }}"
                                                    data-target-modal="#modalFullscreen"><i
                                                        class="fas fa-eye fs-2 text-light">
                                                    </i></a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                                                imaginators</p><a class="btn hover-top btn-boots-warning" href="#!">Join
                                                Boots5 </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10"><img class="w-100"
                                    src="{{ asset('theme/assets/img/cta/cta-portfolio.png') }}" alt="..."
                                    style="border-radius:1rem;" /></div>
                        </div>
                        <div class="row justify-content-center my-3">
                            <div class="col-12 col-lg-10">
                                <div class="card bg-soft-pink">
                                    <div class="card-body py-3">
                                        <div class="row">
                                            <div class="col-lg-6 text-center text-lg-start">
                                                <p class="fs--1 my-2 fw-bold text-gradient-pink-soft">All
                                                    rights Reserved &copy; Your Company, 2021</p>
                                            </div>
                                            <div
                                                class="col-lg-6 d-lg-flex align-self-center justify-content-end text-center">
                                                <p class="fs--1 mb-0 text-gradient-pink-soft">Made with <span
                                                        class="fas fa-heart mx-1 text-secondary"></span>by<a
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
                        style="background-image:url('{{ asset('theme/assets/img/sidebars/portfolio.png') }}');">
                    </div>
                    <!--/.bg-holder-->
                    <div
                        class="position-relative d-lg-flex flex-column justify-content-end align-items-end h-100 px-lg-4 px-xxl-5">
                        <h1 class="text-white text-vertical px-5 px-lg-0 opacity-50 fs-xl-3 fs-xxl-4">Portfolio
                        </h1><img class="d-none d-lg-block line-icons mt-5"
                            src="{{ asset('theme/assets/img/lineicons/trophy.png') }}" alt="icon" />
                        <hr class="my-4 w-100 d-none d-lg-block opacity-25" />
                        <div class="flex-between-center d-none d-lg-flex w-100 opacity-75"
                            data-sidebar-link="page-link"><a class="sidebar-nav btn btn-link text-decoration-none px-1"
                                href="#contact"> <i class="fas fa-chevron-left me-lg-2 me-xl-2 me-xxl-4"></i><span
                                    class="text-capitalize">contact</span></a><a
                                class="sidebar-nav btn btn-link text-decoration-none px-1" href="#about"><span
                                    class="text-capitalize">about</span><i
                                    class="fas fa-chevron-right ms-lg-2 ms-xl-2 ms-xxl-4"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of .container-->
</section>
