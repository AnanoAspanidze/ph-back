@if ($paginator->hasPages())
    <nav>
        <div class="paging__container">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a href="#" class="paging__item bt-blue" rel="prev" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <svg class="icon arrow-left">
                        <use xlink:href="#ico-chevron-right"></use>
                    </svg>
                </a>
            @else
                <a class="paging__item bt-blue" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <svg class="icon arrow-left">
                        <use xlink:href="#ico-chevron-right"></use>
                    </svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="paging__item active" aria-current="page">{{ $page }}</a>
                        @else
                            <a class="paging__item" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="paging__item bt-blue" rel="next" aria-label="@lang('pagination.next')">
                    <svg class="icon">
                        <use xlink:href="#ico-chevron-right"></use>
                    </svg>
                </a>
            @else
                <a href="#" rel="next" aria-disabled="true"  class="paging__item bt-blue disabled" aria-label="@lang('pagination.next')">
                    <svg class="icon">
                        <use xlink:href="#ico-chevron-right"></use>
                    </svg>
                </a>
            @endif
        </ul>
    </nav>
@endif