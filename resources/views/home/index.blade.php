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
                <a href="/profile/{{ $home->users_user_id }}">{{ $home->profiles_name }}</a><br>{!! $home->content !!}
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

<!-- フッターの呼び出し -->
@include('home.footer')

<!--アサイドの呼び出し -->
@include('commons.aside')
@endsection

<!--フットの呼び出し-->
@include('commons.foot')
<script src="/js/home/update-table.js"></script>