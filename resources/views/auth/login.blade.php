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
            {!! Form::open(['method' => 'POST', 'url' => '/login', 'class' => 'form-signin']) !!}
            <span id="reauth-email" class="reauth-email"></span>
            {!! Form::email('email', '', ['class' => 'rounded-pill col-lg-2 mb-3 form-control' . ( $errors->has('email') ? ' is-invalid' : '' ), 'placeholder' => 'メールアドレス', 'required', 'autofocus']) !!}
            {!! Form::password('password', ['class' => 'rounded-pill col-lg-2 mb-3 form-control' . ( $errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'パスワード', 'required']) !!}
            {!! Form::submit('ログイン', ['class'=>'btn btn-outline-primary rounded-pill col-lg-4']) !!}
            {!! Form::close() !!}
        </div>
        <div>
            <button class="btn btn-outline-danger rounded-pill col-lg-4" onClick="alert('未実装です。実装までお待ちください。')">
                <s>パスワードを忘れた方</s>
            </button>
            <button class="btn btn-outline-success rounded-pill col-lg-4" data-bs-target="#tmp-register-modal" data-bs-toggle="modal">
                アカウント登録
            </button>
        </div>
    </div>
</div>
@endsection

<!-- アカウント登録のモーダル画面の呼び出し -->
@include('auth.modals.register')

<!-- ワンタイムパスワード発行のモーダル画面の呼び出し -->
@include('auth.modals.tmp-register')

<!-- フットの呼び出し -->
@include('commons.foot')

<script src="/js/auth/register.js"></script>
<script src="/js/auth/tmp-register.js"></script>