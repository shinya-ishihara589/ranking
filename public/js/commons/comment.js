function clickSendCommentButton() {
    //オーバーレイをONにする
    onOverlay();

    //機能名を取得する
    let funcName = '';

    //コメントを取得する
    let comment = $('#comment').val();

    //URLを取得する
    let url = `/comments/send`;

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: {
            'comment': comment
        }
    }).done(function () {
        //入力欄を初期化する
        resetInput('send-comment-form');

        //モーダル画面を非表示にする
        $('#send-comment-form').modal('hide');
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