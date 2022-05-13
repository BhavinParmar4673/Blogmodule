@foreach ($projects as $key => $myproject)
    <div class="col-lg-6 col-sm-12 mb-4">
        <div class="itembox all">
            <div class="portfolio-item">
                <a class="portfolio-link" href={{ route('project.show', $myproject->id) }}>
                    <div class="thumbnail">
                        @foreach ($myproject->project_images as $image)
                            <img class="img-fluid" src="{{ $image->image_src }}" alt="..." />';
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
