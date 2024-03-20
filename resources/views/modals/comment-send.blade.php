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
                        {!! Form::textarea('comment', '', ['id' => 'modal-comment', 'class' => 'form-control' . ($errors->has('comment') ? ' is-invalid' : '')]) !!}
                        {!! $errors->first('comment', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" onClick="clickButtonCommentSend()">送信</button>
                </div>
            </div>
        </div>
    </div>
@endsection