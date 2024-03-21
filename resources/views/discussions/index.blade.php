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
    <thead class="fs-5 fw-bold">
        <tr>
            <th scope="col" class="col-md-1 text-center">項目</th>
            <th scope="col" class="col-md-1 text-center">内容</th>
            <th scope="col" class="col-md-4 text-left">テキスト</th>
            <th scope="col" class="col-md-1 text-center">コメント数</th>
            <th scope="col" class="col-md-1 text-center">ステータス</th>
            <th scope="col" class="col-md-1 text-center">日時</th>
        </tr>
    </thead>
    <tbody class="fs-6" id="discussion-body-table">
        @foreach ($discussionData as $no => $discussion)
        <tr onClick="getDiscussionDetail({{ $discussion->id }});">
            <th class="text-center">{{ $no + 1 }}</th>
            <td class="text-center">{{ $discussion->item->name }}</td>
            <td class="text-left">{{ $discussion->text }}</td>
            <td class="text-center">{{ count($discussion->comments) }}</td>
            <td class="text-center">{{ $discussion->status }}</td>
            <td class="text-center">{{ $discussion->datetime }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="fs-6">
        <tr>
            <td colspan="5" id="notification-foot-table" class="text-center text-primary" onClick="getUpdateData()">
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

<!--フットの呼び出し-->
@include('commons.foot')

<script>
    function getDiscussionDetail(discussionId) {
        window.location.href = `/discussions/${discussionId}`;
    }
</script>