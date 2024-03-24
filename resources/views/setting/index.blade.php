<!-- レイアウトの呼び出し -->
@extends('layouts.default')

<!-- ヘッドの呼び出し -->
@include('commons.head')

<!-- コンテンツの呼び出し -->
@section('contents')

<!-- ナビゲーションの呼び出し -->
@include('commons.nav')

<!-- ヘッダーの呼び出し -->
@include('setting.header')

<!-- ランキング -->
{!! Form::open(['url' => '/setting', 'method' => 'POST', 'class' => 'd-flex']) !!}
{!! Form::text('email', $userData->email, ['class' => 'form-control me-1 rounded-pill', 'id' => 'home-words', 'placeholder' => '検索ワード']) !!}
{!! Form::submit('更新', ['class'=>'btn btn-outline-success rounded-pill']) !!}
{!! Form::close() !!}

<!-- アサイドの呼び出し -->
@include('commons.aside')
@endsection

<!-- フットの呼び出し -->
@include('commons.foot')

<script src="/js/acquisitions/ranking.js"></script>