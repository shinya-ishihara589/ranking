<!-- レイアウトの呼び出し -->
@extends('layouts.default')

<!-- ヘッドの呼び出し -->
@include('commons.head')

<!-- コンテンツの呼び出し -->
@section('contents')

<!-- ナビゲーションの呼び出し -->
@include('commons.nav')

<!-- ヘッダーの呼び出し -->
@include('ranking.header')

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

<!-- フッターの呼び出し -->
@include('ranking.footer')

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