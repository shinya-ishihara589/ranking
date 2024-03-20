function clickButtonCommentSend() {
    //コメントを取得する
    let comment = $('#modal-comment').val();

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
    }).fail(function (error) {
        console.log(error);
    });
    $('#comment-send-modal').modal('hide');
}