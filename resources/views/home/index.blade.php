<!-- レイアウトの呼び出し -->
@extends('layouts.default')

<!-- へッドの呼び出し -->
@include('commons.head')

<!-- コンテンツの呼び出し -->
@section('contents')

<!-- ナビゲーションの呼び出し -->
@include('commons.nav')

<!-- ヘッダーの呼び出し -->
@include('home.header')

<!-- ランキング -->
<table class="table align-middle">
    <thead class="fs-6 fw-bold">
        <tr>
            <th scope="col" class="col-md-1 text-center text-primary">種類</th>
            <th scope="col" class="col-md-4 text-primary">行動</th>
            <th scope="col" class="col-md-2 text-center text-primary">日時</th>
        </tr>
    </thead>
    <tbody class="fs-6" id="home-body-table">
        @foreach ($homeData as $home)
        <tr>
            <th class="text-center">
                @if($home->home == 'vote')
                投票
                @elseif($home->home == 'comment')
                コメント
                @elseif($home->home == 'discussion')
                議論
                @endif
            </th>
            <td class="text-left">
                @if($home->home == 'vote')
                <a href="/ranking/{{ $home->item_id }}">{{ $home->name }}</a>
                @elseif($home->home == 'comment')
                {!! nl2br(e($home->comment)) !!}
                @elseif($home->home == 'discussion')
                <a href="">{{ $home->name }}</a><br>
                {{ $home->text }}
                @endif
            </td>
            <td class="text-center">{{ $home->datetime }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="fs-6">
        <tr>
            <td colspan="3" id="home-foot-table" class="text-center text-primary" onClick="getUpdateData()">
                <i class="nav-icon bi-arrow-clockwise"></i>
                取得する
                <i class="nav-icon bi-arrow-counterclockwise"></i>
            </td>
        </tr>
    </tfoot>
</table>

<!-- フッターの呼び出し -->
@include('home.footer')

<!--アサイドの呼び出し -->
@include('commons.aside')
@endsection

<!--フットの呼び出し-->
@include('commons.foot')

<script src="/js/acquisitions/home.js"></script>