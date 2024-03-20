@section('commons.footer')
<footer class="text-left pb-3 sticky-bottom bg-white">
    <div role="group">
        <button class="btn btn-primary col-lg-2 rounded-pill change-button" id="button-all">
            <a class="nav-link active" onClick="clickChangeButtonHome('all')">総合</a>
        </button>
        <button class="btn btn-outline-primary col-lg-2 rounded-pill change-button" id="button-vote">
            <a class="nav-link active" onClick="clickChangeButtonHome('vote')">投票</a>
        </button>
        <button class="btn btn-outline-primary col-lg-2 rounded-pill change-button" id="button-comment">
            <a class="nav-link active" onClick="clickChangeButtonHome('comment')">コメント</a>
        </button>
        <button class="btn btn-outline-primary col-lg-2 rounded-pill change-button" id="button-discussion">
            <a class="nav-link active" onClick="clickChangeButtonHome('discussion')">議論</a>
        </button>
    </div>
    <div class="mt-3 d-flex">
        {!! Form::text('words', '', ['class' => 'form-control me-1 rounded-pill', 'id' => 'home-words', 'placeholder' => '検索ワード']) !!}
        {!! Form::hidden('mode', 'all', ['id' => 'home-mode']) !!}
        {!! Form::button('リセット', ['class'=>'btn btn-outline-secondary rounded-pill me-1 col-lg-1', 'onClick' => 'clickResetButtonHome()']) !!}
        {!! Form::button('検索', ['class'=>'btn btn-outline-primary rounded-pill col-lg-1', 'onClick' => 'clickSearchButtonHome()']) !!}
    </div>
</footer>
@endsection