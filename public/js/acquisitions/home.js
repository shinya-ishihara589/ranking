function getUpdateData() {
    //画面を非活性化する
    $('#home-foot-table').prop('disabled', true);

    //URLを取得する
    let url = location.pathname;

    //検索ワードを取得する
    let words = $("#home-words").val();

    //取得開始数を取得する
    let offset = $("#home-body-table").children().length + 1;

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: {
            'words': words,
            'offset': offset
        }
    }).done(function (data) {
        //テーブルを更新する
        let table = '';
        for (let i = 0; i < data.homeData.length; i++) {
            //1.項目種類がvoteの場合は投票の処理を実行する
            //2.項目種類がcommentの場合はコメントの処理を実行する
            //3.項目種類がdiscussionの場合は投票の処理を実行する
            if (data.homeData[i].home == 'vote') {
                var type = '投票';
                var action = `<a href="/ranking/all/${data.homeData[i].item_id}">`;
                action += data.homeData[i].name == null ? '' : data.homeData[i].name;
                action += '</a>';
            } else if (data.homeData[i].home == 'comment') {
                var type = 'コメント';
                var action = data.homeData[i].comment.replace(/\r?\n/g, '<br>');
            } else if (data.homeData[i].home == 'discussion') {
                var type = '議論';
                var action = `<a href="/ranking/all/${data.homeData[i].item_id}">`;
                action += data.homeData[i].name == null ? '' : data.homeData[i].name;
                action += '</a>';
                action += '<br>';
                action += data.homeData[i].text.replace(/\r?\n/g, '<br>');
            }

            //テーブルを追加する
            table += `<tr>`;
            table += `<th class="text-center">${type}</th>`;
            table += `<td class="text-left">${action}</td>`;
            table += `<td class="text-center">${data.homeData[i].datetime}</td>`;
            table += `</tr>`;
        }
        $('#home-body-table').append(table);
    }).fail(function (error) {
        console.log(error);
    });
}
