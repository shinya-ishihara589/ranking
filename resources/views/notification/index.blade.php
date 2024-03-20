<!-- レイアウトの呼び出し -->
@extends('layouts.default')

<!-- へッドの呼び出し -->
@include('commons.head')

<!-- コンテンツの呼び出し -->
@section('contents')

<!-- ナビゲーションの呼び出し -->
@include('commons.nav')

<!-- ヘッダーの呼び出し -->
@include('notification.header')

<!-- ランキング -->
<table class="table align-middle">
    <thead class="fs-6 fw-bold">
        <tr>
            <th scope="col" class="col-md-1 text-center text-primary">種類</th>
            <th scope="col" class="col-md-4 text-primary">行動</th>
            <th scope="col" class="col-md-2 text-center text-primary">日時</th>
        </tr>
    </thead>
    <tbody class="fs-6" id="notification-body-table">
        @foreach ($notificationData as $notification)
        <tr>
            <th class="text-center">
                @if($notification->home == 'vote')
                投票
                @elseif($notification->home == 'comment')
                コメント
                @elseif($notification->home == 'discussion')
                議論
                @endif
            </th>
            <td class="text-left">
                @if($notification->home == 'vote')
                <a href="/ranking/{{ $home->item_id }}">{{ $notification->name }}</a>
                @elseif($notification->home == 'comment')
                {!! nl2br(e($notification->comment)) !!}
                @elseif($notification->home == 'discussion')
                <a href="">{{ $notification->name }}</a><br>
                {{ $notification->text }}
                @endif
            </td>
            <td class="text-center">{{ $notification->datetime }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="fs-6">
        <tr>
            <td colspan="3" id="notification-foot-table" class="text-center text-primary" onClick="getUpdateData()">
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

<script src="/js/acquisitions/home.js"></script>