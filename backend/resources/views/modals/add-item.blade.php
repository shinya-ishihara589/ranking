@section('modals.add-item')
<div class="modal fade" id="add-item-modal" aria-hidden="true" aria-labelledby="add-item-modal-label" data-bs-toggle="add-item-modal-close" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="add-item-modal-label">パスワード</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control input-field', 'placeholder' => '名前']) !!}
                    <span class="invalid-feedback" id='name_error' role="alert"></span>
                </div>
            </div>
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="add-item-modal-label">パスワード確認</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control input-field', 'placeholder' => 'パスワード確認']) !!}
                    <span class="invalid-feedback" id='name_error' role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickAddItemButtonRanking({{ $itemId }})">追加</button>
            </div>
        </div>
    </div>
</div>
@endsection