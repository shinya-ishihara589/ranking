function clickButtonApplySend(itemId) {
    //申請の種類を取得する
    let applyType = $('#modal-apply-type').val();

    //申請テキストを取得する
    let applyText = $('#modal-apply-text').val();

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
            'apply_type': applyType,
            'apply_text': applyText,
            'item_id': itemId
        }
    }).done(function () {
        alert('申告の送信が完了しました。');
    }).fail(function (error) {
        console.log(error);
    });
    $('#apply-send-modal').modal('hide');
}
