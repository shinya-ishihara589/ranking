function clickRegisterButton() {
    //オーバーレイをONにする
    onOverlay();

    //ユーザーIDを取得する
    let registerUserId = $('#register_user_id').val();

    //メールアドレスを取得する
    let registerEmail = $('#register_email').val();

    //ワンタイムパスワードを取得する
    let registerOnetimePassword = $('#register_onetime_password').val();

    //URLを取得する
    let url = '/register';

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: {
            'register_user_id': registerUserId,
            'register_email': registerEmail,
            'register_onetime_password': registerOnetimePassword
        }
    }).done(function () {
        //入力欄を初期化する
        resetInput('register-form');

        //モーダル画面を非表示にする
        $('#register-modal').modal('hide');
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