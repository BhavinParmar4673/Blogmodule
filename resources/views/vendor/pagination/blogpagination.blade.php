@if ($paginator->hasPages())
    <nav class="blog-pagination justify-content-center d-flex">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a href="#" class="page-link" aria-label="Previous">
                        <span aria-hidden="true">
                            <span class="ti-arrow-left"></span>
                        </span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><span aria-hidden="true">
                        <span class="ti-arrow-left"></span>
                    </span></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><a href="#" class="page-link"><span>{{ $element }}</span></a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><a href="#" class="page-link">{{ $page }}</a></li>
                        @else
                            <li class="page-item" aria-current="page"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><span aria-hidden="true"><span class="ti-arrow-right"></span></span></a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a href="#" class="page-link" aria-label="Next">
                        <span aria-hidden="true">
                            <span class="ti-arrow-right"></span>
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
