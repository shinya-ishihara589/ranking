@section('modals.change-password')
<div class="modal" id="add-item-modal" data-show="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="add-item-modal-label">パスワード変更</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control input-field', 'placeholder' => 'パスワード']) !!}
                    <span class="invalid-feedback" id='name_error' role="alert"></span>
                </div>
            </div>
            <div class="modal-body">
                <div>
                    {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control input-field', 'placeholder' => 'パスワード']) !!}
                    <span class="invalid-feedback" id='name_error' role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal">変更しない</button>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickAddItemButtonRanking()">変更する</button>
            </div>
        </div>
    </div>
</div>
@endsection