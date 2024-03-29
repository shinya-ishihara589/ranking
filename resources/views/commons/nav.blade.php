@section('commons.nav')
<nav class="d-flex p-3 sticky-top">
    <ul class="fs-5 nav nav-pills flex-column mb-auto">
        <div class="container-fluid">
            <div class='d-none d-lg-block'>
                <a class="top-50 start-50 translate-middle">
                    <img src="{{ asset('storage/developer/common_logo.jpg') }}" alt="Logo" width="64px" height="64px" class="d-inline-block align-text-top">
                </a>
            </div>
            <div class='d-lg-none text-center'>
                <a class="top-50 start-50 translate-middle">
                    <img src="{{ asset('storage/developer/common_logo.jpg') }}" alt="Logo" width="32px" height="32px" class="d-inline-block align-text-top">
                </a>
            </div>
        </div>
        <li>
            <a href="/" class="nav-link">
                <div class='d-none d-lg-block'>
                    <i class="nav-icon bi-house-door"></i>
                    ホーム
                </div>
                <div class='d-lg-none text-center'>
                    <i class="nav-icon bi-house-door"></i>
                </div>
            </a>
        </li>
        <li>
            <a href="/ranking" class="nav-link">
                <div class='d-none d-lg-block'>
                    <i class="nav-icon bi-clipboard-data"></i>
                    ランキング
                </div>
                <div class='d-lg-none text-center'>
                    <i class="nav-icon bi-clipboard-data"></i>
                </div>
            </a>
        </li>
        <li>
            <a href="/search" class="nav-link">
                <div class='d-none d-lg-block'>
                    <i class="nav-icon bi-search"></i>
                    検索
                </div>
                <div class='d-lg-none text-center'>
                    <i class="nav-icon bi-search"></i>
                </div>
            </a>
        </li>
        <li>
            <a href="/notifications" class="nav-link">
                <div class='d-none d-lg-block'>
                    <i class="nav-icon bi-bell"></i>
                    通知
                </div>
                <div class='d-lg-none text-center'>
                    <i class="nav-icon bi-bell"></i>
                </div>
            </a>
        </li>
        <li>
            <a href="/discussions" class="nav-link">
                <div class='d-none d-lg-block'>
                    <i class="nav-icon bi-people"></i>
                    議論
                </div>
                <div class='d-lg-none text-center'>
                    <i class="nav-icon bi-people"></i>
                </div>
            </a>
        </li>
        <li>
            <a href="/profile/{{ $commons['user_id'] }}" class="nav-link">
                <div class='d-none d-lg-block'>
                    <i class="nav-icon bi-person"></i>
                    プロフィール
                </div>
                <div class='d-lg-none text-center'>
                    <i class="nav-icon bi-person"></i>
                </div>
            </a>
        </li>
        <!-- <li>
            <a href="/setting" class="nav-link">
                <i class="nav-icon bi-gear"></i>
                設定
            </a>
        </li> -->
        <li>
            <a href="#" class="nav-link" data-bs-target="#send-comment-modal" data-bs-toggle="modal">
                <div class='d-none d-lg-block'>
                    <i class="nav-icon bi-chat-right-text"></i>
                    コメント
                </div>
                <div class='d-lg-none text-center'>
                    <i class="nav-icon bi-chat-right-text"></i>
                </div>
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