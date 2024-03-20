@section('commons.header')
<header class="text-left pt-3 bg-white sticky-top">
    <p class="h1 text-center text-primary">Circle of Love</p>
    <div class="text-left">
        {{ Breadcrumbs::render('search.index') }}
    </div>
    <div class="mt-3 d-flex">
        {!! Form::text('words', '', ['class' => 'form-control me-1 rounded-pill', 'id' => 'search-words', 'placeholder' => '検索ワード']) !!}
        {!! Form::button('リセット', ['class'=>'btn btn-outline-secondary rounded-pill me-1 col-lg-1', 'onClick' => 'clickResetButtonSearch()']) !!}
        {!! Form::button('検索', ['class'=>'btn btn-outline-primary rounded-pill col-lg-1', 'onClick' => 'clickSearchButtonSearch()']) !!}
    </div>
</header>
@endsection