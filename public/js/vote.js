function clickBtnVote(mode, voteId, itemId) {
    //URLを取得する
    itemId = itemId != undefined ? itemId : '';
    let url = `/ranking/${mode}/${voteId}/${itemId}`;

    //検索ワードを取得する
    let words = $("#ranking-words").val();

    //取得開始数を取得する
    let limit = $("#ranking-body-table-child").children().length;

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr('content'),
        },
        url: url,
        type: 'POST',
        data: {
            'words': words,
            'limit': limit
        }
    }).done(function (data) {
        //親テーブルの投票数を変更する
        if (data.itemData != null) {
            $('#ranking-body-table-vote').text(data.itemData.votes_count);
        }

        //テーブルの行を全て削除する
        $('#ranking-body-table-child').empty();

        //テーブルを更新する
        let table = '';
        for (let i = 0; i < data.rankingData.length; i++) {
            //項目名とリンクを取得する
            var itemName = `<a href="/ranking/${data.rankingData[i].item_id}">`;
            itemName += data.rankingData[i].name == null ? '' : data.rankingData[i].name;
            itemName += '</a>';

            //ボタンのリンク先を取得する
            var onClick = `clickBtnVote('${mode}', ${data.rankingData[i].id}, ${data.rankingData[i].item_id})`;
            var button = `<button type="button" class="btn btn-outline-success btn-sm rounded-pill" onClick="${onClick}">投票</button>`;

            //テーブルを追加する
            table += `<tr>`;
            table += `<th class="text-center">${i + 1}</th>`;
            table += `<td>${itemName}</td>`;
            table += `<td class="text-center">${data.rankingData[i].votes_count}</td>`;
            table += `<td class="text-center">${button}</td>`;
            table += `</tr>`;
        }
        $('#ranking-body-table-child').append(table);
    }).fail(function (error) {
        console.log(error);
    });
}