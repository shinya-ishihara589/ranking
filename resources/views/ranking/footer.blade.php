@section('commons.footer')
<footer class="text-left pb-3 sticky-bottom bg-white">
    <div role="group">
        <button type="button" class="btn btn-primary col-lg-2 rounded-pill change-button" id="button-all">
            <a class="nav-link active" onClick="clickChangeButtonRanking('all')">総合</a>
        </button>
        <button type="button" class="btn btn-outline-primary col-lg-2 rounded-pill change-button" id="button-yearly">
            <a class="nav-link active" onClick="clickChangeButtonRanking('yearly')">年間</a>
        </button>
        <button type="button" class="btn btn-outline-primary col-lg-2 rounded-pill change-button" id="button-monthly">
            <a class="nav-link active" onClick="clickChangeButtonRanking('monthly')">月間</a>
        </button>
        <button type="button" class="btn btn-outline-primary col-lg-2 rounded-pill change-button" id="button-weekly">
            <a class="nav-link active" onClick="clickChangeButtonRanking('weekly')">週間</a>
        </button>
        <button type="button" class="btn btn-outline-primary col-lg-2 rounded-pill change-button" id="button-daily">
            <a class="nav-link active" onClick="clickChangeButtonRanking('daily')">日間</a>
        </button>
    </div>
    <div class="mt-3 d-flex">
        {!! Form::text('words', '', ['class' => 'form-control me-1 rounded-pill', 'id' => 'ranking-words', 'placeholder' => '検索ワード']) !!}
        {!! Form::hidden('mode', 'all', ['id' => 'ranking-mode']) !!}
        {!! Form::hidden('item_id', $itemId, ['id' => 'ranking-item-id']) !!}
        {!! Form::button('リセット', ['class'=>'btn btn-outline-secondary rounded-pill me-1 col-lg-1', 'onClick' => 'clickResetButtonRanking()']) !!}
        {!! Form::button('検索', ['class'=>'btn btn-outline-primary rounded-pill col-lg-1', 'onClick' => 'clickSearchButtonRanking()']) !!}
    </div>
</footer>
@endsection