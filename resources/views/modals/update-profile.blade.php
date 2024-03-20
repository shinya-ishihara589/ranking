@section('modals.update-profile')
<div class="modal fade" id="update-profile-modal" aria-hidden="true" aria-labelledby="update-profile-modal-label" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="update-profile-modal-label">プロフィール</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'update-profile-modal-form', 'enctype' => 'multipart/form-data']) !!}
                <div>
                    <label for="update-profile-modal-banner-path">
                        <img class="form-control-file profile-banner" src="{{ asset('storage/users/' . $userData->user_id . '/' . $userData->profile->banner_path) }}" width="100%" height="200px" style="object-fit: cover">
                    </label>
                    {!! Form::file('banner_file', ['id' => 'update-profile-modal-banner-path', 'class' => 'd-none']) !!}
                </div>
                <div>
                    <label for="update-profile-modal-icon-path">
                        <img class="form-control-file profile-icon" src="{{ asset('storage/users/' . $userData->user_id . '/' . $userData->profile->icon_path) }}" class="rounded-circle" width="64px" height="64px">
                    </label>
                    {!! Form::file('icon_file', ['id' => 'update-profile-modal-icon-path', 'class' => 'd-none']) !!}
                </div>
                <div>
                    {!! Form::text('name', $userData->profile->name, ['class' => ' form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
                    {!! $errors->first('name', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
                </div>
                <div>
                    {!! Form::textarea('self_introduction', $userData->profile->self_introduction, ['class' => 'form-control' . ($errors->has('self_introduction') ? ' is-invalid' : '')]) !!}
                    {!! $errors->first('self_introduction', '<span class="invalid-feedback" role="alert"><strong>:message</strong></span>') !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onClick="clickButtonUpdateProfile()">送信</button>
            </div>
        </div>
    </div>
</div>
@endsection