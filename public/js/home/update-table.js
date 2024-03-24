/**
 * テーブルを検索する
 */
function clickSearchButtonHome() {
    //検索情報を取得する
    let words = $('#home-words').val();

    //画面情報を取得する
    let mode = $('#home-mode').val();

    //URLを取得する
    let url = '/';

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
    let url = '/';

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
    let url = '/';

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
    let url = '/';

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
        //アクションアイコンを取得する
        var actionIcon = `<i class="${data.homeData[i].action_icon}"></i>`;

        //ユーザーアイコンを取得する
        var userIcon = `<img src="${data.homeData[i].profiles_icon_path}" class="rounded-circle" width="32px" height="32px">`;

        //ユーザー名を取得する
        var userName = `<a href="/profile/${data.homeData[i].users_user_id}">${data.homeData[i].profiles_name}</a><br>`;

        //テーブルを追加する
        table += `<tr>`;
        table += `<th class="text-center">${actionIcon}${userIcon}</th>`;
        table += `<td class="align-baseline">${userName}${data.homeData[i].content}</td>`;
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
