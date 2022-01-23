<div class="pagination fl-wrap">
@if ($paginator->lastPage() > 1)

    <a href="{{ $paginator->url(1) }}" class="prevposts-link"><i class="fal fa-long-arrow-left"></i></a>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)

    <a href="{{ $paginator->url($i) }}" class="{{ ($paginator->currentPage() == $i) ? ' current-page' : '' }}">{{ $i }}.</a>
    @endfor

    <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="nextposts-link"><i class="fal fa-long-arrow-right"></i></a>
@endif
</div>