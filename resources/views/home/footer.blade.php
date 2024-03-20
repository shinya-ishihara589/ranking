@section('commons.footer')
<footer class="text-left pb-3 sticky-bottom bg-white">
    <div role="group">
        <button type="button" class="btn {{ $mode == 'all' ? 'btn-primary' : 'btn-outline-primary' }} col-lg-2 rounded-pill">
            <a href="/home" class="nav-link active">総合</a>
        </button>
        <button type="button" class="btn {{ $mode == 'vote' ? 'btn-primary' : 'btn-outline-primary' }} col-lg-2 rounded-pill">
            <a href="/home/vote" class="nav-link active">投票</a>
        </button>
        <button type="button" class="btn {{ $mode == 'comment' ? 'btn-primary' : 'btn-outline-primary' }} col-lg-2 rounded-pill">
            <a href="/home/comment" class="nav-link active">コメント</a>
        </button>
        <button type="button" class="btn {{ $mode == 'discussion' ? 'btn-primary' : 'btn-outline-primary' }} col-lg-2 rounded-pill">
            <a href="/home/discussion" class="nav-link active">議論</a>
        </button>
    </div>
    <div class="mt-3">
        {!! Form::open(['url' => ['/home', $mode != 'all' ? $mode : ''], 'method' => 'get', 'class' => 'd-flex']) !!}
        {!! Form::text('words', $request->words, ['class' => 'form-control me-1 rounded-pill', 'id' => 'home-words', 'placeholder' => '検索ワード']) !!}
        {!! Form::submit('検索', ['class'=>'btn btn-outline-success rounded-pill']) !!}
        {!! Form::close() !!}
    </div>
</footer>
@endsection