@section('modals.edit-profile')
<div class="modal fade" id="edit-profile-modal" aria-hidden="true" aria-labelledby="edit-profile-modal-label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit-profile-modal-label">プロフィール</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'edit-profile-modal-form', 'enctype' => 'multipart/form-data']) !!}
                <div class="mb-3">
                    <label for="edit-profile-modal-banner-path">
                        <img class="form-control-file profile-banner" src="{{ asset('storage/users/' . $userData->user_id . '/' . $userData->profile->banner_path) }}" width="100%" height="200px" style="object-fit: cover">
                    </label>
                    {!! Form::file('banner_file', ['id' => 'edit-profile-modal-banner-path', 'class' => 'd-none']) !!}
                </div>
                <div class="mb-3">
                    <label for="edit-profile-modal-icon-path">
                        <img class="form-control-file profile-icon" src="{{ asset('storage/users/' . $userData->user_id . '/' . $userData->profile->icon_path) }}" class="rounded-circle" width="64px" height="64px">
                    </label>
                    {!! Form::file('icon_file', ['id' => 'edit-profile-modal-icon-path', 'class' => 'd-none']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::text('name', $userData->profile->name, ['id' => 'name', 'class' => 'form-control input-field', 'placeholder' => '名前']) !!}
                    <span class="invalid-feedback" id='name_error' role="alert"></span>
                </div>
                <div>
                    {!! Form::textarea('self_introduction', '', ['id' => 'self_introduction', 'class' => 'form-control input-field', 'placeholder' => '自己紹介']) !!}
                    <span class="invalid-feedback" id='self_introduction_error' role="alert"></span>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickButtonUpdateProfile()">更新</button>
            </div>
        </div>
    </div>
</div>
@endsection