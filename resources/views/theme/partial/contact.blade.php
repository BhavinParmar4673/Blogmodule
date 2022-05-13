<section class="page p-0 d-none" id="contact">
    <div class="container-fluid">
        <div class="top-0 w-100">
            <div class="row">
                <div class="col-lg-8 col-xl-9 order-1 order-lg-0 pt-6 pt-lg-0">
                    <section class="pt-8 pt-xl-7 pt-xxl-8 pb-0">
                        <div class="bg-holder bg-size"
                            style="background-image:url('{{ asset('theme/assets/img/contact-bg.png') }}');background-position:left center;background-size:auto;">
                        </div>
                        <!--/.bg-holder-->
                        <div class="container-fluid">
                            <div class="row justify-content-center pb-5">
                                <div class="col-sm-9 col-lg-6">
                                    <div class="text-center mb-5 mb-lg-6">
                                        <h2><span class="fw-medium">Get In </span>Touch</h2>
                                    </div>
                                    <h4>Connect with us</h4>
                                    <p class="mb-7">Having the shortest possible delay between idea
                                        and launch is crucial<br class="d-none d-xxl-block" />in business. </p>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-warning shadow-1"><i class="fas fa-phone fs-1"></i></div>
                                        <div class="flex-1 ms-3">
                                            <p class="fw-bold mb-0 text-gradient-orange-1"><a
                                                    href="tel:+880124332334">{{ $response->contact ?? '' }}</a></p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="icon icon-warning shadow-2"><i class="fas fa-envelope fs-1"></i>
                                        </div>
                                        <div class="flex-1 ms-3">
                                            <p class="fw-bold mb-0 text-gradient-orange-2"> <a
                                                    href="mailto:mail.something@email.com ">{{ $response->email ?? '' }}
                                                </a></p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-warning fs-2 shadow-3"><i
                                                class="fas fa-map-marker-alt"></i></div>
                                        <div class="flex-1 ms-3">
                                            <p class="fw-bold text-gradient-orange-3 mb-0">
                                                {{ $response->address ?? '' }}</p>
                                        </div>
                                    </div>
                                    <hr class="my-6 text-200" />
                                    <div class="text-center mb-5 mb-lg-6">
                                        <h2 class="mb-5">Follow </h2>
                                        <ul class="list-unstyled list-inline">
                                            <li class="list-inline-item mx-2"><a
                                                    href="{{ $response->facebook ?? '' }}"><img
                                                        src="{{ asset('theme/assets/img/icons/facebook.png') }}"
                                                        alt="..." /></a>
                                            </li>
                                            <li class="list-inline-item mx-2"><a
                                                    href="{{ $response->linkedin ?? '' }}"><img
                                                        src="{{ asset('theme/assets/img/icons/linkdin.png') }}"
                                                        alt="..." /></a></li>
                                            <li class="list-inline-item mx-2"><a
                                                    href="{{ $response->whatsapp ?? '' }}"><img
                                                        src="{{ asset('theme/assets/img/icons/twitter.png') }}"
                                                        alt="..." /></a></li>
                                            <li class="list-inline-item mx-2"><a
                                                    href="{{ $response->instagram ?? '' }}"><img
                                                        src="{{ asset('theme/assets/img/icons/youtube.png') }}"
                                                        alt="..." /></a></li>
                                            {{-- <li class="list-inline-item mx-2"><a href="#!"><img
                                                        src="{{ asset('theme/assets/img/icons/google-plus.png') }}"
                                                        alt="..." /></a> --}}
                                            </li>
                                        </ul>
                                    </div>
                                    <hr class="my-6 text-200" />
                                    <h4>Drop us a line</h4>
                                    <p class="mb-7">Our team are eagerly waiting to help you growing
                                        your business. Please feel free to contact with us.</p>
                                    {{-- data-form="data-form" --}}
                                    <div class="alert alert-success message" id="success" style="display:none">
                                    </div>
                                    <div class="alert alert-danger message" id="error" style="display:none">
                                    </div>
                                    <form class="row g-4" method="post"
                                        data-url="{{ route('contact.store') }}" id="contact-form">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label text-700" for="inputName"><i
                                                    class="fas fa-user me-2"></i>NAME</label>
                                            <input class="form-control form-boots-control mt-0" id="inputName" required
                                                type="text" name="name" value="{{ old('name') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label text-700" for="inputEmail4"> <i
                                                    class="fas fa-envelope me-2"></i>YOUR
                                                EMAIL</label>
                                            <input class="form-control form-boots-control mt-0" id="inputEmail4"
                                                required email="true" type="email" name="email"
                                                value="{{ old('email') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label text-700" for="inputTextArea4">
                                                <i class="fas fa-pen me-2"></i>MESSAGE</label>
                                            <textarea class="form-control border-400 form-boots-control mt-0" placeholder="Message" rows="6" cols="50"
                                                name="message">{{ old('message') }} </textarea>
                                        </div>
                                        <button id="submit" class="btn btn-boots-warning w-100 mt-5"
                                            type="submit">Send</button>
                                        <div class="feedback"> </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-4 py-3">
                                <div class="col-12 col-lg-10">
                                    <div class="rounded googlemap min-vh-50" data-gmap="data-gmap"
                                        data-latlng="22.2874,70.7914" data-scrollwheel="false"
                                        data-icon="{{ asset('theme/assets/img/map-marker.png') }}" data-zoom="17"
                                        data-theme="Default">
                                        <div class="marker-content py-3">
                                            <h5>Eiffel Tower</h5>
                                            <p>Gustave Eiffel's iconic, wrought-iron 1889 tower,<br /> with
                                                steps and elevators to observation decks. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center my-3">
                                <div class="col-12 col-lg-10">
                                    <div class="card bg-soft-orange-1">
                                        <div class="card-body py-3">
                                            <div class="row">
                                                <div class="col-lg-6 text-center text-lg-start">
                                                    <p class="fs--1 my-2 fw-bold text-gradient-orange-soft-1">
                                                        {{ $response->copyrights ?? '' }}</p>
                                                </div>
                                                <div
                                                    class="col-lg-6 d-lg-flex align-self-center justify-content-end text-center">
                                                    <p class="fs--1 mb-0 text-gradient-orange-soft-1">Made with
                                                        <span class="fas fa-heart mx-1 text-warning"></span>by<a
                                                            href="https://themewagon.com/"> Themewagon</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4 col-xl-3 col-12 position-absolute position-lg-relative ps-lg-0">
                    <div class="sticky-top py-4 sticky-area" data-sidebar-close="sidebar-close">
                        <div class="btn-close-boots-container times">
                            <div class="btn-close-boots"></div>
                        </div>
                        <div class="bg-holder sidebar-rounded"
                            style="background-image:url('{{ asset('theme/assets/img/sidebars/contact.png') }}');">
                        </div>
                        <!--/.bg-holder-->
                        <div
                            class="position-relative d-lg-flex flex-column justify-content-end align-items-end h-100 px-lg-4 px-xxl-5">
                            <h1 class="text-white text-vertical px-5 px-lg-0 opacity-50 fs-xl-3 fs-xxl-4">
                                Contact</h1><img class="d-none d-lg-block line-icons mt-5"
                                src="{{ asset('theme/assets/img/lineicons/map.png') }}" alt="icon" />
                            <hr class="my-4 w-100 d-none d-lg-block opacity-25" />
                            <div class="flex-between-center d-none d-lg-flex w-100 opacity-75"
                                data-sidebar-link="page-link"><a
                                    class="sidebar-nav btn btn-link text-decoration-none px-1" href="#services"> <i
                                        class="fas fa-chevron-left me-lg-2 me-xl-2 me-xxl-4"></i><span
                                        class="text-capitalize">services</span></a><a
                                    class="sidebar-nav btn btn-link text-decoration-none px-1" href="#portfolio"><span
                                        class="text-capitalize">portfolio</span><i
                                        class="fas fa-chevron-right ms-lg-2 ms-xl-2 ms-xxl-4"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of .container-->
</section>
