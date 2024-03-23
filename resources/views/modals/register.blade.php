@section('modals.register')
<div class="modal" id="register-modal" aria-hidden="true" aria-labelledby="register-modal-label" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">アカウント登録</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="clickCloseButton('register-form')"></button>
            </div>
            <form class="modal-body mb-0" id="register-form">
                <div>
                    {!! Form::text('onetime_password', '', ['id' => 'onetime_password', 'class' => 'form-control input-field', 'placeholder' => 'ワンタイムパスワード']) !!}
                    <span class="invalid-feedback" id='onetime_password_error' role="alert"></span>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal" onClick="clickCloseButton('register-form')">閉じる</button>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickButtonRegister()">発行</button>
            </div>
        </div>
    </div>
</div>
@endsection