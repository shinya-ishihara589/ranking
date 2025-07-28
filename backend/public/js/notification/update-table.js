/**
 * テーブルを追加する
 */
function clickAcquisitionButtonNotification() {
    //取得開始数を取得する
    let offset = $("#notification-body-table").children().length;

    //URLを取得する
    let url = '/notifications';

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: {
            'offset': offset
        }
    }).done(function (data) {
        //テーブルを生成する
        updateTable(data);
    }).fail(function (error) {
        console.log(error);
    });
}

/**
 * テーブルを更新する
 * @param {Array} data テーブル情報
 */
function updateTable(data) {
    //テーブルを更新する
    let table = '';
    for (let i = 0; i < data.notificationData.length; i++) {
        //送信者情報を取得する
        var sender = data.notificationData[i].sender.profile != null ? data.notificationData[i].sender.profile.name : data.notificationData[i].sender.user_id;

        //テーブルを追加する
        table += `<tr>`;
        table += `<th class="text-center">${sender}</th>`;
        table += `<td class="text-left">${data.notificationData[i].text}</td>`;
        table += `<td class="text-center">${data.notificationData[i].datetime}</td>`;
        table += `</tr>`;
    }
    $('#notification-body-table').append(table);
}

