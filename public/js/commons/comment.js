function clickSendCommentButton() {
    //オーバーレイをONにする
    onOverlay();

    //コメントを取得する
    let sendCommentComment = $('#send_comment_comment').val();

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
            'send_comment_comment': sendCommentComment
        }
    }).done(function () {
        //入力欄を初期化する
        resetInput('send-comment-form');

        //モーダル画面を非表示にする
        $('#send-comment-modal').modal('hide');
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