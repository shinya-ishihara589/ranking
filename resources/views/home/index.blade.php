<!-- レイアウトの呼び出し -->
@extends('layouts.default')

<!-- へッドの呼び出し -->
@include('commons.head')

<!-- コンテンツの呼び出し -->
@section('contents')

<!-- ナビゲーションの呼び出し -->
@include('commons.nav')

<!-- ヘッダーの呼び出し -->
<x-header view_name="home.index" />

<!-- ランキング -->
<table class="table align-middle">
    <thead class="fs-5 fw-bold">
        <tr>
            <th scope="col" class="col-md-1 text-center">行動</th>
            <th scope="col" class="col-md-8"></th>
            <th scope="col" class="col-md-2 text-center">日時</th>
        </tr>
    </thead>
    <tbody class="fs-6" id="home-body-table">
        @foreach ($homeData as $home)
        <tr>
            <th class="text-center">
                <i class="{{ $home->action_icon }}"></i><img src="{{ $home->profiles_icon_path }}" class="rounded-circle" width="32px" height="32px">
            </th>
            <td class="align-baseline">
                <a href="/profile/{{ $home->users_user_id }}">{{ $home->profiles_name }}</a><br>
                @if ($home->action_icon == 'bi bi-chat-right-text')
                {!! nl2br(e($home->content)) !!}
                @else
                {!! $home->content !!}
                @endif
            </td>
            <td class="text-center">{{ $home->datetime }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="fs-6">
        <tr>
            <td colspan="3" id="home-foot-table" class="text-center text-primary" onClick="clickAcquisitionButtonHome()">
                <i class="nav-icon bi-arrow-clockwise"></i>
                取得する
                <i class="nav-icon bi-arrow-counterclockwise"></i>
            </td>
        </tr>
    </tfoot>
</table>

<!-- フッター -->
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

<!--アサイドの呼び出し -->
@include('commons.aside')
@endsection

<!-- 申請のモーダル画面の呼び出し -->
@include('modals.search')

<!-- 申請のモーダル画面の呼び出し -->
@include('modals.change-password')

<!--フットの呼び出し-->
@include('commons.foot')
<script src="/js/home/update-table.js"></script>