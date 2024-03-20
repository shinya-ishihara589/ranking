<!-- レイアウトの呼び出し -->
@extends('layouts.default')

<!-- ヘッドの呼び出し -->
@include('commons.head')

<!-- コンテンツの呼び出し -->
@section('contents')

<!-- ナビゲーションの呼び出し -->
@include('commons.nav')

<!-- ランキング -->
<header>
	<div class="profile-banner">
		<img src="{{ asset('storage/users/' . $userData->user_id . '/' . $userData->profile->banner_path) }}" width="100%" height="200px" style="object-fit: cover">
	</div>
	<div class="profile-icon">
		<img src="{{ asset('storage/users/' . $userData->user_id . '/' . $userData->profile->icon_path) }}" class="rounded-circle" width="64px" height="64px">
	</div>
	<div id="profile-name">
		{{ isset($userData->profile->name) ? $userData->profile->name : $userData->user_id }}
	</div>
	<div>
		<button type="button" class="btn btn-outline-warning btn-sm rounded-pill" data-bs-target="#update-profile-modal" data-bs-toggle="modal">プロフィール変更</button>
	</div>
	<div id="profile-self-introduction">
		{!! nl2br(e($userData->profile->self_introduction)) !!}
	</div>
</header>
<table class="table align-middle">
	<thead class="fs-6 fw-bold">
		<tr>
			<th scope="col" class="col-md-1 text-center">順位</th>
			<th scope="col" class="col-md-4">名前</th>
			<th scope="col" class="col-md-1 text-center"></th>
		</tr>
	</thead>
	<tbody class="fs-6" id="ranking-body-table-child">
		@foreach ($profileData as $profile)
		<tr>
			<th class="text-center">
				@if($profile->home == 'vote')
				投票
				@elseif($profile->home == 'comment')
				コメント
				@elseif($profile->home == 'discussion')
				議論
				@endif
			</th>
			<td class="text-left">
				@if($profile->home == 'vote')
				<a href="/ranking/{{ $profile->item_id }}">{{ $profile->name }}</a>
				@elseif($profile->home == 'comment')
				{!! nl2br(e($profile->comment)) !!}
				@elseif($profile->home == 'discussion')
				<a href="">{{ $profile->name }}</a><br>
				{{ $profile->text }}
				@endif
			</td>
			<td class="text-center">{{ $profile->datetime }}</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot class="fs-6">
		<tr>
			<td colspan="4" id="home-foot-table" class="text-center text-primary" onClick="getUpdateData('')">
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

<!-- プロフィール変更のモーダル画面の呼び出し -->
@include('modals.update-profile')

<!-- フットの呼び出し -->
@include('commons.foot')

<script src="/js/updates/profile.js"></script>