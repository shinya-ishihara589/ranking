@section('commons.footer')
<footer class="text-left pb-3 sticky-bottom bg-white">
    <div role="group">
        <button type="button" class="btn {{ $mode == 'all' ? 'btn-primary' : 'btn-outline-primary' }} col-lg-2 rounded-pill">
            <a href="/ranking/all{{ isset($itemId) ? '/' . $itemId : '' }}" class="nav-link active">総合</a>
        </button>
        <button type="button" class="btn {{ $mode == 'yearly' ? 'btn-primary' : 'btn-outline-primary' }} col-lg-2 rounded-pill">
            <a href="/ranking/yearly{{ isset($itemId) ? '/' . $itemId : '' }}" class="nav-link active">年間</a>
        </button>
        <button type="button" class="btn {{ $mode == 'monthly' ? 'btn-primary' : 'btn-outline-primary' }} col-lg-2 rounded-pill">
            <a href="/ranking/monthly{{ isset($itemId) ? '/' . $itemId : '' }}" class="nav-link active">週間</a>
        </button>
        <button type="button" class="btn {{ $mode == 'weekly' ? 'btn-primary' : 'btn-outline-primary' }} col-lg-2 rounded-pill">
            <a href="/ranking/weekly{{ isset($itemId) ? '/' . $itemId : '' }}" class="nav-link active">月間</a>
        </button>
        <button type="button" class="btn {{ $mode == 'daily' ? 'btn-primary' : 'btn-outline-primary' }} col-lg-2 rounded-pill">
            <a href="/ranking/daily{{ isset($itemId) ? '/' . $itemId : '' }}" class="nav-link active">日間</a>
        </button>
    </div>
    <div class="mt-3">
        {!! Form::open(['url' => ['/ranking', $mode, $itemId], 'method' => 'get', 'class' => 'd-flex']) !!}
        {!! Form::text('words', $request->words, ['class' => 'form-control me-1 rounded-pill', 'id' => 'ranking-words', 'placeholder' => '検索ワード']) !!}
        {!! Form::submit('検索', ['class'=>'btn btn-outline-success rounded-pill']) !!}
        {!! Form::close() !!}
    </div>
</footer>
@endsection