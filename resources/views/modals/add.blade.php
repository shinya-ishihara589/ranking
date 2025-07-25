<!-- 修正 -->
@section('modals.add')
<div>
    <div class="modal" id="tmp-register-modal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">アカウント仮登録</h1>{{ $title }}
                    <button class="btn-close" data-bs-dismiss="modal" onClick="clickCloseButton('tmp-register-form')"></button>
                </div>
                <form class="modal-body mb-0" id="tmp-register-form">
                    <div class="mb-3">
                        {!! Form::text('tmp_register_user_id', '', ['id' => 'tmp_register_user_id', 'class' => 'form-control input-field', 'placeholder' => 'ユーザーID']) !!}
                        <span class="invalid-feedback" id='tmp_register_user_id_error' role="alert"></span>
                    </div>
                    <div>
                        {!! Form::text('tmp_register_email', '', ['id' => 'tmp_register_email', 'class' => 'form-control input-field', 'placeholder' => 'メールアドレス']) !!}
                        <span class="invalid-feedback" id='tmp_register_email_error' role="alert"></span>
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal" onClick="clickCloseButton()">閉じる</button>
                    <button class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickTmpRegisterButton(); alert('仮登録情報をメールアドレスに送信しました。')">仮登録</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection