@extends('emails.default')
@section('content')
<div>
    ワンタイムパスワード{{ $onetime_password }}<br>
</div>
@endsection