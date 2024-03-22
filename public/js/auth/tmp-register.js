function clickButtonTmpRegister() {
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
            'tmp_user_id': tmpUserId,
            'tmp_email': tmpEmail
        }
    }).done(function () {
        //モーダル画面を非表示にする
        $('#tmp-register-modal').modal('hide');

        //モーダル画面を表示する
        $('#register-modal').modal('show');
    }).fail(function (error) {
        console.log(error);
    });
}