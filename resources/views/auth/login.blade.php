<!-- レイアウトの呼び出し -->
@extends('layouts.default')

<!-- へッドの呼び出し -->
@include('commons.head')

<div class="container" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); display: flex;  align-items: center; justify-content: center;">
    <div class="card card-container d-flex col-lg-6 p-3">
        {!! Form::open(['method' => 'POST', 'route' => 'login', 'class' => 'form-signin']) !!}
        <span id="reauth-email" class="reauth-email"></span>
        {!! Form::email('email', '', ['class' => 'rounded-pill col-lg-2 mb-3 form-control' . ( $errors->has('email') ? ' is-invalid' : '' ), 'placeholder' => 'メールアドレス', 'required', 'autofocus']) !!}
        {!! Form::password('password', ['class' => 'rounded-pill col-lg-2 mb-3 form-control' . ( $errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'パスワード', 'required']) !!}
        {!! Form::submit('ログイン', ['class'=>'btn btn-outline-primary rounded-pill col-lg-4']) !!}
        {!! Form::close() !!}
        <button href="#" class="btn btn-outline-danger rounded-pill col-lg-6 mb-3">
            パスワードを忘れた方
        </button>
        <button href="#" class="btn btn-outline-success rounded-pill col-lg-6">
            アカウント登録
        </button>
    </div>
</div>

<!--フットの呼び出し-->
@include('commons.foot')