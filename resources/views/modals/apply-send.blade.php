@section('modals.apply-send')
@if(isset($itemData))
<div class="modal fade" id="apply-send-modal" aria-hidden="true" aria-labelledby="apply-send-modal-label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="apply-send-modal-label">項目「{{ $itemData->name }}」への申請</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    {!! Form::select('type', $applyTypes, '', ['id' => 'type', 'class' => 'form-control input-field']) !!}
                    <span class="invalid-feedback" id='type_error' role="alert"></span>
                </div>
                <div>
                    {!! Form::textarea('text', '', ['id' => 'text', 'class' => 'form-control input-field', 'placeholder' => '申請内容&#10;例：完壁は誤りのため、完璧に修正してください。']) !!}
                    <span class="invalid-feedback" id='text_error' role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickButtonApplySend({{ $itemData->id }})">送信</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection