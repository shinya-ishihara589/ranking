@extends('emails.default')
@section('content')
<div>
    ユーザーID{{ $userId }}<br>
    パスワード：{{ $password }}<br>
</div>
@endsection