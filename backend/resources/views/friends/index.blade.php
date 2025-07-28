<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
        <link rel="stylesheet" href="{{ asset('/css/friend-list.css') }}">
		<title></title>
	</head>

	<body>
		<header>
			<h1><p id="title">praiser circle</p></h1>
			<nav>
				<ul id="menu">
					<li><a href="index.html" id="top">表紙</a></li>
					<li><a href="mail.html" id="letter">投票</a></li>
					<li><a href=# id="hoge">０３</a></li>
					<li><a href=# id="update">０４</a></li>
					<li><a href=# id="setting">０５</a></li>
				</ul>
			</nav>
		</header>

		<article>
			@foreach ($friends as $key => $friend)
				<div class="contents">
					<p class="icon"><img border="0" src="{{ asset('storage/icon/' . $friend->user->profile->icon_path) }}" class="icon"></p>
					<div class="comment">
						<p class="cmt-nam">{{ $friend->user->name }}</p>
						<p class="cmt-txt">
							{{ $friend->user->profile->introduction }}
						</p>
					</div>
				</div>
			@endforeach
		</article>
		
		<footer>
			<form>
				<input id="search-txt" type="search" />
				<input id="search-box" type="button" value="検索" />
			</form>
			<p id="admin">管理者：切切舞八三三</p>
		</footer>
	<div style="text-align: center;"><div style="display: inline-block; position: relative; z-index: 9999;"><script type="text/javascript" charset="utf-8" src="//asumi.shinobi.jp/fire?f=434"></script></div></div></body>
</html>