function clickButtonUpdateProfile() {
    //フォーム情報を取得する
    let formData = new FormData($('#update-profile-modal-form').get()[0]);

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
        $('#profile-name').text(data.profileData.name);
        $('#profile-self-introduction').html(selfIntroduction);

        //モーダル画面を表示にする
        $('#update-profile-modal').modal('hide');
    }).fail(function (error) {
        //入力欄のエラーメッセージを非表示にする
        hideErrorMeaage();

        //入力欄のエラーメッセージを表示する
        showErrorMeaage(error);
    });
}