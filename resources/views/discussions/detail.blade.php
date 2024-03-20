<!-- レイアウトの呼び出し -->
@extends('layouts.default')

<!-- Headの呼び出し -->
@include('commons.head')

<!-- ヘッダーの呼び出し -->
@include('discussions.header')

<!-- コンテンツの呼び出し -->
@section('contents')

<!-- ナビゲーションの呼び出し -->
@include('commons.nav')

<!-- 議論一覧 -->
<table class="table align-middle">
    <thead class="fs-6 fw-bold">
        <tr>
            <th scope="col" class="col-md-1 text-center">項目</th>
            <th scope="col" class="col-md-4 text-left">テキスト</th>
            <th scope="col" class="col-md-1 text-center">日時</th>
        </tr>
    </thead>
    <tbody class="fs-6" id="discussion-body-table">
        <tr>
            <th scope="row" class="text-center">親コメント</th>
            <td class="text-left">{{ $discussionData->text }}</td>
            <td class="text-center">{{ $discussionData->datetime }}</td>
        </tr>
        @foreach ($discussionData->comments as $no => $comment)
        <tr>
            <th scope="row" class="text-center">{{ $no + 1 }}</th>
            <td class="text-left">{{ $comment->comment }}</td>
            <td class="text-center">{{ $comment->datetime }}</td>
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

<!-- アサイドの呼び出し -->
@include('commons.aside')
@endsection

<script>
    function getDiscussionDetail(discussionId) {
        window.location.href = `/discussions/${discussionId}`;
    }
</script>