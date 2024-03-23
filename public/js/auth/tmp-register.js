function clickButtonTmpRegister() {
    //オーバーレイをONにする
    onOverlay();

    //機能名を取得する
    let funcName = 'tmp_';

    //仮ユーザーIDを取得する
    let tmpUserId = $('#tmp_user_id').val();

    //仮メールアドレスを取得する
    let tmpEmail = $('#tmp_email').val();

    //URLを取得する
    let url = '/tmp_register';

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: {
            'user_id': tmpUserId,
            'email': tmpEmail
        }
    }).done(function () {
        //入力欄を初期化する
        resetInput('tmp-register-form');

        //モーダル画面を非表示にする
        $('#tmp-register-modal').modal('hide');

        //モーダル画面を表示する
        $('#register-modal').modal('show');
    }).fail(function (error) {
        //入力欄のエラーメッセージを非表示にする
        hideErrorMeaage();

        //入力欄のエラーメッセージを表示する
        showErrorMeaage(error, funcName);
    }).always(function () {
        //オーバーレイをOFFにする
        offOverlay();
    });
}