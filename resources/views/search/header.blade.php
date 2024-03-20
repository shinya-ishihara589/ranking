@section('commons.header')
<header class="text-left pt-3 bg-white sticky-top">
    <p class="h1 text-center text-primary">Circle of Love</p>
    <div class="text-left">
        {{ Breadcrumbs::render('search.index') }}
    </div>
    <div class="text-left">
        {!! Form::open(['url' => ['/search'], 'method' => 'get', 'class' => 'd-flex']) !!}
        {!! Form::text('words', $request->words, ['class' => 'form-control me-1 rounded-pill', 'id' => 'search-words', 'placeholder' => '検索ワード']) !!}
        {!! Form::submit('検索', ['class'=>'btn btn-outline-success rounded-pill']) !!}
        {!! Form::close() !!}
    </div>
</header>
@endsection