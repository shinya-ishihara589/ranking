/**
 * テーブルを追加する
 */
function clickAcquisitionButtonProfile() {
    //オーバーレイをONにする
    onOverlay();

    //取得開始数を取得する
    let offset = $("#profile-body-table").children().length;

    //ユーザーIDを取得する
    let pathname = location.pathname;
    let paths = pathname.split('/');
    let userId = paths[paths.length - 1];

    //URLを取得する
    let url = `/profile/${userId}`;

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
    }).always(function () {
        //オーバーレイをOFFにする
        offOverlay();
    });
}

/**
 * テーブルを更新する
 * @param {Array} data テーブル情報
 */
function updateTable(data) {
    //テーブルを更新する
    let table = '';
    for (let i = 0; i < data.profileData.length; i++) {
        //1.項目種類がvoteの場合は投票の処理を実行する
        //2.項目種類がcommentの場合はコメントの処理を実行する
        //3.項目種類がdiscussionの場合は投票の処理を実行する
        if (data.profileData[i].home == 'vote') {
            var type = '投票';
            var action = `<a href="/ranking/all/${data.profileData[i].item_id}">`;
            action += data.profileData[i].name == null ? '' : data.profileData[i].name;
            action += '</a>';
        } else if (data.profileData[i].home == 'comment') {
            var type = 'コメント';
            var action = data.profileData[i].comment.replace(/\r?\n/g, '<br>');
        } else if (data.profileData[i].home == 'discussion') {
            var type = '議論';
            var action = `<a href="/ranking/all/${data.profileData[i].item_id}">`;
            action += data.profileData[i].name == null ? '' : data.profileData[i].name;
            action += '</a>';
            action += '<br>';
            action += data.profileData[i].text.replace(/\r?\n/g, '<br>');
        }

        //テーブルを追加する
        table += `<tr>`;
        table += `<th class="text-center">${type}</th>`;
        table += `<td class="text-left">${action}</td>`;
        table += `<td class="text-center">${data.profileData[i].datetime}</td>`;
        table += `</tr>`;
    }
    $('#profile-body-table').append(table);
}

