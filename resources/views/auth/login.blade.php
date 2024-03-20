
<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        {!! Form::open(['method' => 'POST', 'route' => 'login', 'class' => 'form-signin']) !!}
            <span id="reauth-email" class="reauth-email"></span>
            {!! Form::email('email', '', ['class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' ), 'placeholder' => 'メールアドレス', 'required', 'autofocus']) !!}
            {!! Form::password('password', ['class' => 'form-control' . ( $errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'パスワード', 'required']) !!}
            {!! Form::submit('ログイン', ['class'=>'btn btn-primary btn-block btn-flat']) !!}
        {!! Form::close() !!}
        <a href="#" class="forgot-password">
            パスワードを忘れた方
        </a>
    </div>
</div>
