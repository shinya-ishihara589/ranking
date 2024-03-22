function clickButtonRegister() {
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
        //モーダル画面を非表示にする
        $('#register-modal').modal('hide');
    }).fail(function (error) {
        console.log(error);
    });
}