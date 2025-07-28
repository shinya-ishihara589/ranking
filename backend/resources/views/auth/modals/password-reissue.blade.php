@section('modals.password-reissue')
<div class="modal" id="password-reissue-modal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">パスワード再発行</h1>
                <button class="btn-close" data-bs-dismiss="modal" onClick="clickCloseButton('password-reissue-form')"></button>
            </div>
            <form class="modal-body mb-0" id="password-reissue-form">
                <div class="mb-3">
                    <input type="text" name="user_id" value="" class="form-control input-field" id="user_id" placeholder="ユーザーID">
                    <span class="invalid-feedback" id='user_id_error' role="alert"></span>
                </div>
                <div>
                    <input type="text" name="email" value="" class="form-control input-field" id="email" placeholder="メールアドレス">
                    <span class="invalid-feedback" id='email_error' role="alert"></span>
                </div>
            </form>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal" onClick="clickCloseButton()">閉じる</button>
                <button class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickForgetPasswordButton(); alert('仮登録情報をメールアドレスに送信しました。')">仮登録</button>
            </div>
        </div>
    </div>
</div>
@endsection