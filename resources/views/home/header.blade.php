@section('commons.header')
<header class="text-left pt-3 bg-white sticky-top">
    <p class="h1 text-center text-primary">Circle of Love</p>
    <div class="text-left">
        @if ($mode == 'all')
        {{ Breadcrumbs::render('home.index') }}
        @elseif ($mode == 'vote')
        {{ Breadcrumbs::render('home.vote') }}
        @elseif ($mode == 'comment')
        {{ Breadcrumbs::render('home.comment') }}
        @elseif ($mode == 'discussion')
        {{ Breadcrumbs::render('home.discussion') }}
        @endif
    </div>
</header>
@endsection