function clickButtonIssueOnetimePassword() {
    //メールアドレスを取得する
    let email = $('#email').val();

    //URLを取得する
    let url = 'issue_onetime_password';

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: {
            'email': email
        }
    }).done(function (data) {
        console.log(data);
    }).fail(function (error) {
        console.log(error);
    });
}