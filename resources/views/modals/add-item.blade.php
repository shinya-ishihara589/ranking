@section('modals.add-item')
<div class="modal fade" id="add-item-modal" aria-hidden="true" aria-labelledby="add-item-modal-label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="add-item-modal-label">項目追加</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    {!! Form::text('modal-item', '', ['id' => 'modal-item', 'class' => 'form-control' . ($errors->has('modal-item') ? ' is-invalid' : '')]) !!}
                    {!! $errors->first('modal-item', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onClick="clickButtonAddItem('{{ $mode }}', {{ $itemId }})">追加</button>
            </div>
        </div>
    </div>
</div>
@endsection