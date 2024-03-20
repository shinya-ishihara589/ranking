@section('commons.footer')
<footer class="text-left mt-3 mb-3 sticky-bottom bg-white">
    {!! Form::open(['url' => ['/', $mode != 'all' ? $mode : ''], 'method' => 'get', 'class' => 'd-flex']) !!}
    {!! Form::text('words', $request->words, ['class' => 'form-control me-1 rounded-pill', 'id' => 'home-words', 'placeholder' => '検索ワード']) !!}
    {!! Form::submit('検索', ['class'=>'btn btn-outline-success rounded-pill']) !!}
    {!! Form::close() !!}
</footer>
@endsection