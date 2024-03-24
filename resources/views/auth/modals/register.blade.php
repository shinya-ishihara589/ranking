@section('modals.register')
<div class="modal" id="register-modal" aria-hidden="true" aria-labelledby="register-modal-label" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">アカウント登録</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clickCloseButton('register-form')"></button>
            </div>
            <form class="modal-body mb-0" id="register-form">
                <!-- {!! Form::open(['method'=>'post','url'=> '/register']) !!} -->
                {!! Form::hidden('register_user_id', '', ['id' => 'register_user_id']) !!}
                {!! Form::hidden('register_email', '', ['id' => 'register_email']) !!}
                <div>
                    {!! Form::text('register_onetime_password', '', ['id' => 'register_onetime_password', 'class' => 'form-control input-field', 'placeholder' => 'ワンタイムパスワード']) !!}
                    <span class="invalid-feedback" id='register_onetime_password_error' role="alert"></span>
                </div>
                <!-- {!! Form::submit('保存する', ['class'=>'btn btn-primary btn-lg']) !!}
            {!! Form::close() !!} -->
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal" onClick="clickCloseButton('register-form')">閉じる</button>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickRegisterButton()">発行</button>
            </div>
        </div>
    </div>
</div>
@endsection