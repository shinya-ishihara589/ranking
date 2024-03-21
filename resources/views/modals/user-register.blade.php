@section('modals.user-register')
<div class="modal fade" id="user-register-modal" aria-hidden="true" aria-labelledby="user-register-modal-label" data-bs-toggle="user-register-modal-close" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="user-register-modal-label">アカウント登録</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    {!! Form::text('user_id', '', ['id' => 'user_id', 'class' => 'form-control input-field', 'placeholder' => 'ユーザーID', 'disabled']) !!}
                    <span class="invalid-feedback" id='name_error' role="alert"></span>
                </div>
                <div>
                    {!! Form::text('onetime_password', '', ['id' => 'onetime_password', 'class' => 'form-control input-field', 'placeholder' => 'ワンタイムパスワード', 'disabled']) !!}
                    <span class="invalid-feedback" id='name_error' role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onClick="">登録</button>
            </div>
        </div>
    </div>
</div>
@endsection