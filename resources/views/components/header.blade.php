<header class="text-left pt-3 bg-white sticky-top">
    <p class="h1 text-center text-primary">PraiserCircle</p>
    <div class="d-flex justify-content-between">
        <div>
            @if ($item_id)
            {{ Breadcrumbs::render($view_name, $item_id) }}
            @else
            {{ Breadcrumbs::render($view_name) }}
            @endif
        </div>
        <div>
            @if ($search_state != '0')
            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" data-bs-target="#search-modal" data-bs-toggle="modal" data-serach-state="{{ $search_state }}">検索</button>
            @endif
        </div>
    </div>
</header>