@section('modals.issue-onetime-password')
<div class="modal fade" id="issue-onetime-password-modal" aria-hidden="true" aria-labelledby="issue-onetime-password-modal-label" data-bs-toggle="issue-onetime-password-modal-close" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="issue-onetime-password-modal-label">ワンタイムパスワードの発行</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    {!! Form::text('email', '', ['id' => 'email', 'class' => 'form-control input-field', 'placeholder' => 'メールアドレス']) !!}
                    <span class="invalid-feedback" id='email_error' role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onClick="">発行</button>
            </div>
        </div>
    </div>
</div>
@endsection