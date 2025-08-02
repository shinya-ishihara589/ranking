<!-- レイアウトの呼び出し -->
@extends('layouts.default')

<!-- ヘッドの呼び出し -->
@include('commons.head')

<!-- コンテンツの呼び出し -->
@section('contents')

<div class="container" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); display: flex; justify-content: center;">
    <div class="card card-container d-flex col-lg-5 p-3">
        <div class="mb-3">
            <img src="{{ asset('storage/developer/login_logo.jpg') }}" alt="Logo" width="100%" height="300px" class="d-inline-block align-text-top">
        </div>
        <div class="mb-3">
            <form>
                <form method="POST" url="/login" id="form-signin">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="email" name="email" value="" class="rounded-pill col-lg-2 mb-3 form-control . {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="メールアドレス" required autofocus>
                    <input type="password" name="password" value="" class="rounded-pill col-lg-2 mb-3 form-control . {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="パスワード" required>
                    <input type="submit" class="btn btn-outline-primary rounded-pill col-lg-4">
                </form>
        </div>
        <div>
            <button class="btn btn-outline-danger rounded-pill col-lg-4" data-bs-target="#password-reissue-modal" data-bs-toggle="modal">
                パスワード再発行
            </button>
            <button class="btn btn-outline-success rounded-pill col-lg-4" data-bs-target="#tmp-register-modal" data-bs-toggle="modal">
                アカウント登録
            </button>
        </div>
    </div>
</div>
@endsection

<!-- パスワード再発行のモーダル画面の呼び出し -->
<x-modals.reissue-password-modal />

<!-- アカウント登録のモーダル画面の呼び出し -->
<x-modals.register-modal />

<!-- ワンタイムパスワード発行のモーダル画面の呼び出し -->
<x-modals.tmp-register-modal />

<!-- フットの呼び出し -->
@include('commons.foot')