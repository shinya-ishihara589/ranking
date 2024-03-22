@section('modals.register')
<div class="modal fade" id="register-modal" aria-hidden="true" aria-labelledby="register-modal-label" data-bs-toggle="register-modal-modal-close" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="register-modal-label">アカウント登録</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    {!! Form::text('user_id', '', ['id' => 'user_id', 'class' => 'form-control input-field', 'placeholder' => 'ユーザーID']) !!}
                    <span class="invalid-feedback" id='user_id_error' role="alert"></span>
                </div>
                <div class="mb-3">
                    {!! Form::text('email', '', ['id' => 'email', 'class' => 'form-control input-field', 'placeholder' => 'メールアドレス']) !!}
                    <span class="invalid-feedback" id='email_error' role="alert"></span>
                </div>
                <div>
                    {!! Form::text('onetime_password', '', ['id' => 'onetime_password', 'class' => 'form-control input-field', 'placeholder' => 'ワンタイムパスワード']) !!}
                    <span class="invalid-feedback" id='onetime_password_error' role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickButtonRegister()">発行</button>
            </div>
        </div>
    </div>
</div>
@endsection