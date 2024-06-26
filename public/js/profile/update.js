function clickButtonUpdateProfile() {
    //オーバーレイをONにする
    onOverlay();

    //フォーム情報を取得する
    let formData = new FormData($('#edit-profile-form').get()[0]);

    //URLを取得する
    let url = `/profile`;

    //プロフィール登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false
    }).done(function (data) {
        //自己紹介情報を取得する
        let selfIntroduction = data.profileData.self_introduction.replace(/\r?\n/g, '<br>');

        //プロフィール情報を変更する
        $('#edit_profile_name').text(data.profileData.name);
        $('#edit_profile_self_introduction').html(selfIntroduction);

        //モーダル画面を表示にする
        $('#edit-profile-modal').modal('hide');
    }).fail(function (error) {
        //入力欄のエラーメッセージを非表示にする
        hideErrorMeaage();

        //入力欄のエラーメッセージを表示する
        showErrorMeaage(error);
    }).always(function () {
        //オーバーレイをOFFにする
        offOverlay();
    });
}