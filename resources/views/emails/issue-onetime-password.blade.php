@extends('emails.default')
@section('content')
<div>
    ※本メールにお心当たりがない場合はお手数ですが破棄をお願いいたします。<br>
    <br>
    ワンタイムパスワード{{ $onetimePassword }}<br>
</div>
@endsection