<div class="modal fade" id="modalFullscreen" tabindex="-1" data-bs-keyboard="false" aria-labelledby="modalFullscreen"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="d-flex justify-content-end border-bottom-0 py-5 px-5"><button
                    class="btn-close position-fixed z-index-1" type="button" data-bs-dismiss="modal"
                    aria-label="Close"></button></div>
            <!-- ============================================-->
            <!-- <section> begin ============================-->
            <section class="pt-7">
                <div class="container-fluid">
                    <div class="row justify-content-center pb-5">
                        <div class="col-lg-8 col-xl-7">
                            <div class="modal-body">
                                <img class="img-fluid" src="{{ $project->image }}" alt="..." />
                                <div class="row my-5">
                                    <h2 class="mb-5 text-start">{{ $project->title ?? '' }}</h2>
                                    <div class="col-lg-6 col-xl-5 text-start">
                                        <h5>Category </h5>
                                        <p>{{ $project->category->name ?? '' }} </p>
                                        <h5>Client</h5>
                                        <p>{{ $project->client ?? '' }}</p><a class="text-800 text-"
                                            href="{{ $project->website ?? '' }}">
                                            <i class="fas fa-link me-2"></i>{{ $project->website ?? '' }}</a>
                                    </div>
                                    <div class="col-lg-6 col-xl-7 border-start text-start mt-4 mt-lg-0">
                                        <h5>Brief</h5>
                                        <p>{{ $project->brief ?? '' }}</p>
                                    </div>
                                </div>
                                {{-- <div class="mb-6">
                                    <p class="my-3 text-start">I must explain to you how all this mistaken idea of
                                        reprobating pleasure and extolling pain arose. To do so, I will give you a
                                        complete account of the system, and expound the actual teachings of the
                                        great explorer of the truth, the master-builder of human happiness. No one
                                        rejects, dislikes or avoids pleasure itself, because it is pleasure, but
                                        because those who do not know how to pursue pleasure rationally encounter
                                        consequences that are extremely painful.</p>
                                    <p class="my-3 text-start">To do so, I will give you a complete account of the
                                        system, and expound the actual teachings of the great explorer of the truth,
                                        the master-builder of human happiness.No one rejects, dislikes or avoids
                                        pleasure itself, because it is pleasure, but because those who do not know
                                        how to pursue pleasure rationally encounter consequences that are extremely
                                        painful.</p>
                                </div> --}}
                                <div class="mb-6">
                                    <p class="my-3 text-start"> {!! $project->view_more ?? '' !!}</p>
                                </div>
                                <div class="row">
                                    @foreach ($project->photo as $key => $img)
                                        <div class="col-md-4 my-2">
                                            <img class="mb-4 img-fluid" src="{{ $img->getUrl() }}" alt="..." />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end of .container-->
            </section><!-- <section> close ============================-->
            <!-- ============================================-->
        </div>
    </div>
</div>
