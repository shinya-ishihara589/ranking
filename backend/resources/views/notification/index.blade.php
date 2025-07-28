<!-- レイアウトの呼び出し -->
@extends('layouts.default')

<!-- へッドの呼び出し -->
@include('commons.head')

<!-- コンテンツの呼び出し -->
@section('contents')

<!-- ナビゲーションの呼び出し -->
@include('commons.nav')

<!-- ヘッダーの呼び出し -->
<x-header view_name="notifications.index" />

<!-- 通知 -->
<table class="table align-middle">
    <thead class="fs-5 fw-bold">
        <tr>
            <th scope="col" class="col-md-1 text-center">ユーザー</th>
            <th scope="col" class="col-md-4">行動</th>
            <th scope="col" class="col-md-2 text-center">日時</th>
        </tr>
    </thead>
    <tbody class="fs-6" id="notification-body-table">
        @foreach ($notificationData as $notification)
        <tr>
            <th class="text-center">
                {{ isset($notification->sender->profile->name) ? $notification->sender->profile->name : $notification->sender->user_id }}
            </th>
            <td class="text-left">{{ $notification->text }}</td>
            <td class="text-center">{{ $notification->datetime }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="fs-6">
        <tr>
            <td colspan="3" id="notification-foot-table" class="text-center text-primary" onClick="clickAcquisitionButtonNotification()">
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

<script src="/js/notification/update-table.js"></script>