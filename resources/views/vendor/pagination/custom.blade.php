@if ($paginator->hasPages())
    <ul class="pagination justify-content-center">
        {{-- First Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="d-none hidden page-item disabled">
                <span class="page-link">&lt;&lt; {{ __('First') }}</span>
            </li>
        @else
            <li class="d-none page-item">
                <a href="{{ $paginator->url(1) }}" class="page-link">&lt;&lt; {{ __('First') }}</a>
            </li>
        @endif

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="previous hidden page-item disabled">
                <span class="page-link">&lt; {{ __('Previous') }}</span>
            </li>
        @else
            <li class="previous page-item">
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link">&lt; {{ __('Previous') }}</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page selected page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page page-item">
                            <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="next page-item">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link">{{ __('Next') }} &gt;</a>
            </li>
        @else
            <li class="next page-item disabled">
                <span class="page-link">{{ __('Next') }} &gt;</span>
            </li>
        @endif

        {{-- Last Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="d-none page-item">
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">{{ __('Last') }} &gt;&gt;</a>
            </li>
        @else
            <li class="d-none page-item disabled">
                <span class="page-link">{{ __('Last') }} &gt;&gt;</span>
            </li>
        @endif
    </ul>
@endif