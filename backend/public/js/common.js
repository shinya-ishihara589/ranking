/**
 * 閉じるボタンをクリックした場合の処理を実行する
 * @param {String} formId FormID
 */
function clickCloseButton(formId) {
    // 入力欄を初期化する
    resetInput(formId);

    // エラーメッセージを非表示にする
    hideErrorMeaage();
}

/**
 * エラーメッセージを表示する
 * @param {Array} formId エラーメッセージ
 */
function showErrorMeaage(error) {
    // エラーメッセージを表示する
    for (var key in error.responseJSON.errors) {
        var message = `<strong class="error-message">${error.responseJSON.errors[key][0]}</strong>`;
        $(`#${key}_error`).append(message)
        $(`#${key}`).addClass('is-invalid');
    }
}

/**
 * エラーメッセージを非表示にする
 */
function hideErrorMeaage() {
    //入力欄のメッセージを非表示にする
    $('.input-field').removeClass('is-invalid');
    $('.error-message').remove();
}

/**
 * オーバーレイをONにする
 */
function onOverlay() {
    //画面をクリックできなくする
    $('div').css('pointer-events', 'none');

    //ロードアイコンを表示する
    $('#overlay').removeClass('d-none');
}

/**
 * オーバーレイをOFFにする
 */
function offOverlay() {
    // 画面をクリックできるようにする
    $('div').css('pointer-events', 'auto');

    // ロードアイコンを非表示にする
    $('#overlay').addClass('d-none');
}

/**
 * 入力欄を初期化する
 * @param {String} formId FormID
 */
function resetInput(formId) {
    //フォーム情報を取得する
    const formData = $(`#${formId}`).serializeArray();

    // 入力欄を初期化する
    for (var key in formData) {
        $(`#${formData[key]['name']}`).val('');
    }
}

/**
 * アクションボタンをクリックした際の処理を実施する
 * @param {String} url URL
 * @param {String} formId FormID
 * @param {String} modalId Modal画面のID
 */
function clickActionButton(url, formId, modalId) {
    // オーバーレイをONにする
    onOverlay();

    // フォーム内の値を全て取得する
    const formData = $(`#${formId}`).serializeArray();
    const dataObject = {};
    formData.forEach(item => {
        dataObject[item.name] = item.value;
    })

    // 項目登録を実行する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")
        },
        url: url,
        type: 'POST',
        data: dataObject
    }).done(function () {
        // 入力欄を初期化する
        resetInput(formId);

        // モーダル画面を非表示にする
        $(`#${modalId}`).modal('hide');
    }).fail(function (error) {
        // 入力欄のエラーメッセージを非表示にする
        hideErrorMeaage();

        // 入力欄のエラーメッセージを表示する
        showErrorMeaage(error);
    }).always(function () {
        // オーバーレイをOFFにする
        offOverlay();
    });
}