@section('commons.header')
<header class="text-left pt-3 bg-white sticky-top">
    <p class="h1 text-center text-primary">Circle of Love</p>
    <div class="text-left">
        @if (true)
        {{ Breadcrumbs::render('discussions.index') }}
        @elseif (ture)
        {{ Breadcrumbs::render('discussions.detail') }}
        @endif
    </div>
</header>
@endsection