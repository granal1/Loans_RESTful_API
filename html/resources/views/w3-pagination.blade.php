@if ($paginator->hasPages())
<div class="w3-center">
    <div class="w3-bar w3-border">
        <nav>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="w3-bar-item w3-btn w3-disabled">&#10094;</span>
            @else
                <a class="w3-bar-item w3-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev" >&#10094;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w3-bar-item w3-btn w3-disabled">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w3-bar-item w3-button w3-blue">{{ $page }}</span>
                        @else
                            <a class="w3-bar-item w3-btn" href="{{ $url }}" rel="prev" >{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="w3-bar-item w3-btn" href="{{ $paginator->nextPageUrl() }}" rel="prev" >&#10095;</a>
            @else
                <span class="w3-bar-item w3-btn w3-disabled">&#10095;</span>
            @endif
        </nav>
    </div>
</div>
@endif
