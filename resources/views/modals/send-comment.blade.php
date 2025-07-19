<!-- 修正 -->
@section('modals.send-comment')

<div class="modal fade" id="" aria-hidden="true" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">コメント</h1>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body mb-0" id="send-comment-form">
                <div>
                    {!! Form::textarea('send_comment_comment', '', ['id' => 'send_comment_comment', 'class' => 'form-control input-field', 'placeholder' => 'コメント']) !!}
                    <span class="invalid-feedback" id='send_comment_comment_error' role="alert"></span>
                </div>
            </form>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal" onClick="clickCloseButton('send-comment-form')">閉じる</button>
                <button class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickSendCommentButton()">送信</button>
            </div>
        </div>
    </div>
</div>
@endsection