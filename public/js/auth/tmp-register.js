function clickTmpRegisterButton() {
    //オーバーレイをONにする
    onOverlay();

    //仮ユーザーIDを取得する
    let tmpRegisterUserId = $('#tmp_register_user_id').val();

    //仮メールアドレスを取得する
    let tmpRegisterEmail = $('#tmp_register_email').val();

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
            'tmp_register_user_id': tmpRegisterUserId,
            'tmp_register_email': tmpRegisterEmail
        }
    }).done(function () {
        //ユーザーIDを取得する
        $('#register_user_id').val(tmpRegisterUserId);

        //メールアドレスを取得する
        $('#register_email').val(tmpRegisterEmail);

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
        showErrorMeaage(error);
    }).always(function () {
        //オーバーレイをOFFにする
        offOverlay();
    });
}