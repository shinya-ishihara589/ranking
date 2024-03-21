function clickButtonApplySend(itemId) {
    //申請の種類を取得する
    let type = $('#type').val();

    //申請テキストを取得する
    let text = $('#text').val();

    //URLを取得する
    let url = `/apply/send`;

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: {
            'type': type,
            'text': text,
            'item_id': itemId
        }
    }).done(function () {
        //アラートメッセージを表示する
        alert('申告の送信が完了しました。');

        //モーダル画面を非表示にする
        $('#apply-send-modal').modal('hide');
    }).fail(function (error) {
        //入力欄のエラーメッセージを非表示にする
        hideErrorMeaage();

        //入力欄のエラーメッセージを表示する
        showErrorMeaage(error);
    });
}
