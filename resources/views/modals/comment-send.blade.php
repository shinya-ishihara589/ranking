@section('modals.comment-send')
<div class="modal fade" id="comment-send-modal" aria-hidden="true" aria-labelledby="comment-send-modal-label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="comment-send-modal-label">コメント</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    {!! Form::textarea('comment', '', ['id' => 'comment', 'class' => 'form-control input-field', 'placeholder' => 'コメント']) !!}
                    <span class="invalid-feedback" id='comment_error' role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickButtonCommentSend()">送信</button>
            </div>
        </div>
    </div>
</div>
@endsection