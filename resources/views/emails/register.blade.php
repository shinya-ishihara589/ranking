@extends('emails.default')
@section('content')
<div>
    ユーザーID{{ $user_id }}<br>
    パスワード{{ $password }}<br>
</div>
@endsection