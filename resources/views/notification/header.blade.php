@section('header')
<header class="text-left pt-3 bg-white sticky-top">
    <p class="h1 text-center text-primary">PraiserCircle</p>
    <div class="text-left">
        {{ Breadcrumbs::render('notifications.index') }}
    </div>
</header>
@endsection