<!-- レイアウトの呼び出し -->
@extends('layouts.default')

<!-- へッドの呼び出し -->
@include('commons.head')

<!-- コンテンツの呼び出し -->
@section('contents')

<!-- ナビゲーションの呼び出し -->
@include('commons.nav')

<!-- ヘッダーの呼び出し -->
@include('search.header')

<!-- ランキング -->
<table class="table align-middle">
    <thead class="fs-5 fw-bold">
        <tr>
            <th scope="col" class="col-md-1 text-center">種類</th>
            <th scope="col" class="col-md-4">行動</th>
            <th scope="col" class="col-md-2 text-center">日時</th>
        </tr>
    </thead>
    <tbody class="fs-6" id="search-body-table">
        @foreach ($searchData as $search)
        <tr>
            <th class="text-center">
                @if($search->home == 'vote')
                投票
                @elseif($search->home == 'comment')
                コメント
                @elseif($search->home == 'discussion')
                議論
                @endif
            </th>
            <td class="text-left">
                @if($search->home == 'vote')
                <a href="/ranking/{{ $search->item_id }}">{{ $search->name }}</a>
                @elseif($search->home == 'comment')
                {!! nl2br(e($search->comment)) !!}
                @elseif($search->home == 'discussion')
                <a href="">{{ $search->name }}</a><br>
                {{ $search->text }}
                @endif
            </td>
            <td class="text-center">{{ $search->datetime }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="fs-6">
        <tr>
            <td colspan="3" id="search-foot-table" class="text-center text-primary" onClick="clickAcquisitionButtonSearch()">
                <i class="nav-icon bi-arrow-clockwise"></i>
                取得する
                <i class="nav-icon bi-arrow-counterclockwise"></i>
            </td>
        </tr>
    </tfoot>
</table>

<!--アサイドの呼び出し -->
@include('commons.aside')
@endsection

<!--フットの呼び出し-->
@include('commons.foot')

<script src="/js/search/update-table.js"></script>