function clickButtonRegister() {
    //機能名を取得する
    let funcName = 'tmp_';

    //ユーザーIDを取得する
    let user_id = $('#user_id').val();

    //ワンタイムパスワードを取得する
    let onetime_password = $('#onetime_password').val();

    //メールアドレスを取得する
    let email = $('#email').val();

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
            'user_id': user_id,
            'onetime_password': onetime_password,
            'email': email
        }
    }).done(function () {
        //入力欄を初期化する
        resetInput('register-form');

        //モーダル画面を非表示にする
        $('#register-modal').modal('hide');

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