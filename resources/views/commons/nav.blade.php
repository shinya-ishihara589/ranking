@section('commons.nav')
<nav class="d-flex p-3 sticky-top">
    <ul class="fs-5 nav nav-pills flex-column mb-auto">
        <div class="container-fluid">
            <a class="top-50 start-50 translate-middle">
                <img src="{{ asset('storage/users/seeder/icon.jpg') }}" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
            </a>
        </div>
        <li>
            <a href="/home" class="nav-link">
                <i class="nav-icon bi-house-door"></i>
                ホーム
            </a>
        </li>
        <li>
            <a href="/ranking/all" class="nav-link">
                <i class="nav-icon bi-clipboard-data"></i>
                ランキング
            </a>
        </li>
        <li>
            <a href="/search" class="nav-link">
                <i class="nav-icon bi-search"></i>
                検索
            </a>
        </li>
        <li>
            <a href="/notifications" class="nav-link">
                <i class="nav-icon bi-bell"></i>
                通知
            </a>
        </li>
        <li>
            <a href="/discussions" class="nav-link">
                <i class="nav-icon bi-people"></i>
                議論
            </a>
        </li>
        <li>
            <a href="/profile/{{ $commons['users']['id'] }}" class="nav-link">
                <i class="nav-icon bi-person"></i>
                プロフィール
            </a>
        </li>
        <li>
            <a href="/setting" class="nav-link">
                <i class="nav-icon bi-gear"></i>
                設定
            </a>
        </li>
        <li>
            <a href="#" class="nav-link" data-bs-target="#comment-send-modal" data-bs-toggle="modal">
                <i class="nav-icon bi-chat-right-text"></i>
                コメント
            </a>
        </li>
        <li>
            <a href="/logout" class="nav-link">
                ログアウト
            </a>
        </li>
    </ul>
</nav>
@endsection