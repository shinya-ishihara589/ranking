function clickSendApplyButton(itemId) {
    //オーバーレイをONにする
    onOverlay();

    //申請の種類を取得する
    let sendApplyType = $('#send_apply_type').val();

    //申請テキストを取得する
    let sendApplyText = $('#send_apply_text').val();

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
            'send_apply_type': sendApplyType,
            'send_apply_text': sendApplyText,
            'item_id': itemId
        }
    }).done(function (data) {
        console.log(data);
        //アラートメッセージを表示する
        alert('申告の送信が完了しました。');

        //モーダル画面を非表示にする
        $('#send-apply-modal').modal('hide');
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

