<nav class="pagination">
    <ul class="pagination__list">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <li><a rel="prev" href="#" class="pagination__previous btn-squae disable">&#8249;</a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" class="pagination__previous btn-squae" rel="prev">&#8249;</a></li>
        @endif

       <!--  <li><a rel="prev" href="#" class="pagination__previous btn-squae disable">&#8249;</a></li>

        <li><span class="pagination__page btn-squae active">1</span></li>
        <li><a href="#" class="pagination__page btn-squae">2</a></li>
        <li><a href="#" class="pagination__page btn-squae">...</a></li>
        <li><a href="#" class="pagination__page btn-squae">14</a></li> -->

        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="pagination__page btn-squae active"><span>{{ $page }}</span></li>
                    @else
                        <li><a class="pagination__page btn-squae" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" class="pagination__next btn-squae" rel="next">&#8250;</a></li>
        @else
            <li><a rel="prev" href="#" class="pagination__previous btn-squae disable">&#8250;</a></li>
        @endif
    </ul>
</nav>
