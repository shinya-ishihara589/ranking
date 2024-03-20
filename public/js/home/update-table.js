/**
 * テーブルを検索する
 */
function clickSearchButtonHome() {
    //検索情報を取得する
    let words = $('#home-words').val();

    //画面情報を取得する
    let mode = $('#home-mode').val();

    //URLを取得する
    let url = '/get';

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
    }).done(function (data) {
        //テーブルの行を全て削除する
        $('#home-body-table').empty();

        //テーブルを生成する
        updateTable(data);
    }).fail(function (error) {
        console.log(error);
    });
}

/**
 * テーブルの検索をリセットする
 */
function clickResetButtonHome() {
    //検索情報を取得する
    $('#home-words').val('');

    //画面情報を取得する
    let mode = $('#home-mode').val();

    //URLを取得する
    let url = '/get';

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
        $('#home-body-table').empty();

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
function clickChangeButtonHome(mode) {
    //検索情報を取得する
    let words = $('#home-words').val();

    //画面情報を更新する
    $('#home-mode').val(mode);

    //URLを取得する
    let url = '/get';

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
    }).done(function (data) {
        //テーブルの行を全て削除する
        $('#home-body-table').empty();

        //テーブルを生成する
        updateTable(data);
    }).fail(function (error) {
        console.log(error);
    });
}

/**
 * テーブルを追加する
 */
function clickAcquisitionButtonHome() {
    //検索情報を取得する
    let words = $('#home-words').val();

    //画面情報を取得する
    let mode = $('#home-mode').val();

    //取得開始数を取得する
    let offset = $("#home-body-table").children().length + 1;

    //URLを取得する
    let url = '/get';

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

/**
 * テーブルを更新する
 * @param {Array} data テーブル情報
 */
function updateTable(data) {
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

    //ボタンのクラス属性を更新する
    updateClass();
}

/**
 * クラス属性を更新する
 * @param {String} target 
 */
function updateClass() {
    //画面情報を取得する
    let mode = $('#home-mode').val();

    //画面情報を更新する
    $('.change-button').removeClass('btn-primary')
    $('.change-button').removeClass('btn-outline-primary')
    $('.change-button').addClass('btn-outline-primary')
    $(`#button-${mode}`).removeClass('btn-outline-primary')
    $(`#button-${mode}`).addClass('btn-primary');
}
