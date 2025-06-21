<header class="text-left pt-3 bg-white sticky-top">
    <p class="h1 text-center text-primary">PraiserCircle</p>
    <div class="text-left">
        @if ($item_id)
        {{ Breadcrumbs::render($view_name, $item_id) }}
        @else
        {{ Breadcrumbs::render($view_name) }}
        @endif
    </div>
</header>