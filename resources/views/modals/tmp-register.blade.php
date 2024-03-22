@section('modals.tmp-register')
<div class="modal fade" id="tmp-register-modal" aria-hidden="true" aria-labelledby="tmp-register-modal-label" data-bs-toggle="tmp-register-modal-close" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tmp-register-modal-label">仮登録</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    {!! Form::text('tmp_user_id', '', ['id' => 'tmp_user_id', 'class' => 'form-control input-field', 'placeholder' => 'ユーザーID']) !!}
                    <span class="invalid-feedback" id='tmp_user_id_error' role="alert"></span>
                </div>
                <div>
                    {!! Form::text('tmp_email', '', ['id' => 'tmp_email', 'class' => 'form-control input-field', 'placeholder' => 'メールアドレス']) !!}
                    <span class="invalid-feedback" id='tmp_email_error' role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickButtonTmpRegister()">発行</button>
            </div>
        </div>
    </div>
</div>
@endsection