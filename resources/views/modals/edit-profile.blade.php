@section('modals.edit-profile')
<div class="modal fade" id="edit-profile-modal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">プロフィール</h1>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            {!! Form::open(['class' => 'modal-body mb-0', 'id' => 'edit-profile-form', 'enctype' => 'multipart/form-data']) !!}
            <div class="mb-3">
                <label for="edit-profile-banner-path">
                    <img class="form-control-file profile-banner" src="{{ asset('storage/users/' . $userData->user_id . '/' . $userData->profile->banner_path) }}" width="100%" height="200px" style="object-fit: cover">
                </label>
                {!! Form::file('banner_file', ['id' => 'edit-profile-modal-banner-path', 'class' => 'd-none']) !!}
            </div>
            <div class="mb-3">
                <label for="edit-profile-icon-path">
                    <img class="form-control-file profile-icon" src="{{ asset('storage/users/' . $userData->user_id . '/' . $userData->profile->icon_path) }}" class="rounded-circle" width="64px" height="64px">
                </label>
                {!! Form::file('icon_file', ['id' => 'edit-profile-icon-path', 'class' => 'd-none']) !!}
            </div>
            <div class="mb-3">
                {!! Form::text('edit_profile_name', $userData->profile->name, ['id' => 'edit_profile_name', 'class' => 'form-control input-field', 'placeholder' => '名前']) !!}
                <span class="invalid-feedback" id='edit_profile_name_error' role="alert"></span>
            </div>
            <div>
                {!! Form::textarea('edit_profile_self_introduction', $userData->profile->self_introduction, ['id' => 'edit_profile_self_introduction', 'class' => 'form-control input-field', 'placeholder' => '自己紹介']) !!}
                <span class="invalid-feedback" id='edit_profile_self_introduction_error' role="alert"></span>
            </div>
            {!! Form::close() !!}
            <div class="modal-footer">
                <button class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-dismiss="modal">閉じる</button>
                <button class="btn btn-outline-primary btn-sm rounded-pill" onClick="clickButtonUpdateProfile()">更新</button>
            </div>
        </div>
    </div>
</div>
@endsection