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
                    {!! Form::select('modal_apply_type', $applyTypes, '', ['id' => 'modal-apply-type', 'class' => 'form-select' . ($errors->has('modal_apply_type') ? ' is-invalid' : '')]) !!}
                    {!! $errors->first('modal_apply_type', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
                </div>
                <div>
                    {!! Form::textarea('modal_apply_text', '', ['id' => 'modal-apply-text', 'class' => 'form-control' . ($errors->has('modal_apply_text') ? ' is-invalid' : '')]) !!}
                    {!! $errors->first('modal_apply_text', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onClick="clickButtonApplySend({{ $itemData->id }})">送信</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection