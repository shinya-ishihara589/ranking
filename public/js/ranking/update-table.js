/**
 * テーブルを検索する
 */
function clickSearchButtonRanking() {
    //検索情報を取得する
    let words = $('#ranking-words').val();

    //画面情報を取得する
    let mode = $('#ranking-mode').val();

    //項目IDを取得する
    let itemId = $('#ranking-item-id').val();

    //URLを取得する
    let url = `/ranking/${itemId}`;

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: {
            'words': words,
            'mode': mode
        }
    }).done(function (data,) {
        //テーブルの行を全て削除する
        $('#ranking-body-table').empty();

        //テーブルを生成する
        updateTable(data);
    }).fail(function (error) {
        console.log(error);
    });
}

/**
 * テーブルの検索をリセットする
 */
function clickResetButtonRanking() {
    //検索情報を空欄にする
    $('#ranking-words').val('');

    //画面情報を取得する
    let mode = $('#ranking-mode').val();

    //項目IDを取得する
    let itemId = $('#ranking-item-id').val();

    //URLを取得する
    let url = `/ranking/${itemId}`;

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: {
            'words': '',
            'mode': mode
        }
    }).done(function (data) {
        //テーブルの行を全て削除する
        $('#ranking-body-table').empty();

        //テーブルを生成する
        updateTable(data);
    }).fail(function (error) {
        console.log(error);
    });
}

/**
 * テーブルを変更する
 * @param {String} data 画面情報
 */
function clickChangeButtonRanking(mode) {
    //検索情報を取得する
    let words = $('#ranking-words').val();

    //画面情報を更新する
    $('#ranking-mode').val(mode);

    //項目IDを取得する
    let itemId = $('#ranking-item-id').val();

    //テーブル数を取得する
    let limit = $("#ranking-body-table").children().length;

    //URLを取得する
    let url = `/ranking/${itemId}`;

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: {
            'words': words,
            'mode': mode,
            'limit': limit
        }
    }).done(function (data) {
        //テーブルの行を全て削除する
        $('#ranking-body-table').empty();

        //テーブルを生成する
        updateTable(data);
    }).fail(function (error) {
        console.log(error);
    });
}

/**
 * テーブルを追加する
 */
function clickAcquisitionButtonRanking() {
    //検索情報を取得する
    let words = $('#ranking-words').val();

    //画面情報を更新する
    let mode = $('#ranking-mode').val();

    //項目IDを取得する
    let itemId = $('#ranking-item-id').val();

    //URLを取得する
    let url = `/ranking/${itemId}`;

    //取得開始数を取得する
    let offset = $("#ranking-body-table").children().length + 1;

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: {
            'words': words,
            'mode': mode,
            'offset': offset
        }
    }).done(function (data) {
        //テーブルを生成する
        updateTable(data);
    }).fail(function (error) {
        console.log(error);
    });
}

function clickButtonVote(voteId) {
    //検索情報を取得する
    let words = $('#ranking-words').val();

    //画面情報を更新する
    let mode = $('#ranking-mode').val();

    //項目IDを取得する
    let itemId = $('#ranking-item-id').val();

    //テーブル数を取得する
    let limit = $("#ranking-body-table").children().length;

    //URLを取得する
    let url = `/ranking/vote/${voteId}`;

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr('content'),
        },
        url: url,
        type: 'POST',
        data: {
            'words': words,
            'mode': mode,
            'itemId': itemId,
            'limit': limit
        }
    }).done(function (data) {
        //テーブルボディの行を全て削除する
        $('#ranking-body-table').empty();

        //テーブルを生成する
        updateTable(data);
    }).fail(function (error) {
        console.log(error);
    });
}

/**
 * 項目を追加する
 */
function clickAddItemButtonRanking() {
    //検索情報を取得する
    let words = $('#ranking-words').val();

    //画面情報を取得する
    let mode = $('#ranking-mode').val();

    //項目名を取得する
    let name = $('#name').val();

    //項目IDを取得する
    let itemId = $('#ranking-item-id').val();

    //URLを取得する
    let url = `/item/add/${itemId}`;

    //項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: {
            'words': words,
            'mode': mode,
            'name': name,
            'limit': 0
        }
    }).done(function (data) {
        //テーブルの行を全て削除する
        $('#ranking-body-table').empty();

        //テーブルを生成する
        updateTable(data);

        //モーダル画面を非表示にする
        $('#add-item-modal').modal('hide');
    }).fail(function (error) {
        //入力欄のエラーメッセージを非表示にする
        hideErrorMeaage();

        //入力欄のエラーメッセージを表示する
        showErrorMeaage(error);
    });
}

/**
 * テーブルを更新する
 * @param {Array} data テーブル情報
 */
function updateTable(data) {
    //項目IDを取得する
    let itemId = $('#ranking-item-id').val();

    //項目IDが存在する場合は投票数を変更する
    if (itemId) {
        //投票数を変更する
        $('#ranking-head-table-vote').text(data.itemData.votes_count);
    }

    //テーブルボディの行数を取得する
    let row = $("#ranking-body-table").children().length + 1;

    //テーブルボディを更新する
    let tableBody = '';
    for (let i = 0; i < data.rankingData.length; i++) {
        //リンクを取得する
        var link = data.rankingData[i].id != null ? '/' + data.rankingData[i].id : '';

        //投票数を取得する
        var voteCount = data.rankingData[i].votes_count ? data.rankingData[i].votes_count : 0;

        //テーブルボディを追加する
        tableBody += `<tr>`;
        tableBody += `<th class="text-center">${row++}</th>`;
        tableBody += `<td><a href="/ranking${link}">${data.rankingData[i].name}</a></td>`;
        tableBody += `<td class="text-center">${voteCount}</td>`;
        tableBody += `<td class="text-center">`;
        tableBody += `<button type="button" class="btn btn-outline-success btn-sm rounded-pill" onClick="clickButtonVote(${data.rankingData[i].id})">投票</button>`;
        tableBody += `</td>`;
        tableBody += `</tr>`;
    }
    $('#ranking-body-table').append(tableBody);

    //ボタンのクラス属性を更新する
    updateClass();
}

/**
 * クラス属性を更新する
 * @param {String} target 
 */
function updateClass() {
    //画面情報を取得する
    let mode = $('#ranking-mode').val();

    //画面情報を更新する
    $('.change-button').removeClass('btn-primary')
    $('.change-button').removeClass('btn-outline-primary')
    $('.change-button').addClass('btn-outline-primary')
    $(`#button-${mode}`).removeClass('btn-outline-primary')
    $(`#button-${mode}`).addClass('btn-primary');
}
