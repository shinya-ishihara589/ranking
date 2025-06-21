<!-- レイアウトの呼び出し -->
@extends('layouts.default')

<!-- ヘッドの呼び出し -->
@include('commons.head')

<!-- コンテンツの呼び出し -->
@section('contents')

<!-- ナビゲーションの呼び出し -->
@include('commons.nav')

<!-- ヘッダーの呼び出し -->
<x-header view_name="ranking.index" :item_id="$itemId" />

<!-- タイトル -->
@if ($itemData)
<table class="table align-middle">
    <thead class="fs-4 fw-bold">
        <tr>
            <th scope="col" class="col-md-1 text-center">
                <button type="button" class="btn btn-outline-warning btn-sm rounded-pill" data-bs-target="#send-apply-modal" data-bs-toggle="modal">申請</button>
            </th>
            <th scope="col" class="col-md-4 text-primary" id="item-id-{{ $itemData->id }}">{{ $itemData->name }}</th>
            <th scope="col" class="col-md-1 text-center text-primary" id="ranking-head-table-vote">{{ $itemData->votes_count }}</th>
            <th scope="col" class="col-md-1 text-center text-primary">
                <button type="button" class="btn btn-outline-success btn-sm rounded-pill" onClick="clickButtonVote({{ $itemData->id }})">投票</button>
            </th>
        </tr>
    </thead>
</table>
@endif

<!-- ランキング -->
<table class="table align-middle">
    <thead class="fs-5 fw-bold">
        <tr>
            <th scope="col" class="col-md-1 text-center">順位</th>
            <th scope="col" class="col-md-4">名前</th>
            <th scope="col" class="col-md-1 text-center">票数</th>
            <th scope="col" class="col-md-1 text-center">
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" data-bs-target="#add-item-modal" data-bs-toggle="modal">追加</button>
            </th>
        </tr>
    </thead>
    <tbody class="fs-6" id="ranking-body-table">
        @foreach ($rankingData as $no => $ranking)
        <tr>
            <th scope="row" class="text-center">{{ $no + 1 }}</th>
            <td>
                <a href="/ranking{{ isset($ranking->id) ? '/' . $ranking->id : '' }}" id="item-id-{{ $ranking->id }}">{{ $ranking->name }}</a>
            </td>
            <td class="text-center">{{ isset($ranking->votes_count) ? $ranking->votes_count : 0 }}</td>
            <td class="text-center">
                <button type="button" class="btn btn-outline-success btn-sm rounded-pill" onClick="clickButtonVote({{ $ranking->id }})">投票</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="fs-6">
        <tr>
            <td colspan="4" id="ranking-foot-table" class="text-center text-primary" onClick="clickAcquisitionButtonRanking()">
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

<!-- アサイドの呼び出し -->
@include('commons.aside')
@endsection

<!-- 項目追加のモーダル画面の呼び出し -->
@include('modals.add-item')

<!-- 申請のモーダル画面の呼び出し -->
@include('modals.send-apply')

<!-- フットの呼び出し -->
@include('commons.foot')

<script src="/js/apply/send.js"></script>
<script src="/js/adds/item.js"></script>

<script src="/js/ranking/update-table.js"></script>