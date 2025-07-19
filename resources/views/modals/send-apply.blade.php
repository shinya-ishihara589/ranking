<!-- 修正 -->
@section('modals.send-apply')
@if(isset($itemData))
<div class="modal" id="send-apply-modal" aria-hidden="true" tabindex="-1" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">項目「{{ $itemData->name }}」への申請</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body mb-0" id="send-apply-form">
                <div class="mb-3">
                    {!! Form::select('send_apply_type', $applyTypes, '', ['id' => 'send_apply_type', 'class' => 'form-control input-field']) !!}
                    <span class="invalid-feedback" id='send_apply_type_error' role="alert"></span>
                </div>
                <div>
                    {!! Form::textarea('send_apply_text', '', ['id' => 'send_apply_text', 'class' => 'form-control input-field', 'placeholder' => '申請内容&#10;例：完壁は誤りのため、完璧に修正してください。']) !!}
                    <span class="invalid-feedback" id='send_apply_text_error' role="alert"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal" onClick="clickCloseButton('apply-form')">閉じる</button>
                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickSendApplyButton({{ $itemData->id }})">送信</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection