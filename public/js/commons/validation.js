/**
 * エラーメッセージを表示する
 */
function showErrorMeaage(error, funcName) {
    //エラーメッセージを表示する
    for (var key in error.responseJSON.errors) {
        var message = `<strong class="error-message">${error.responseJSON.errors[key][0]}</strong>`;
        $(`#${funcName}${key}_error`).append(message)
        $(`#${funcName}${key}`).addClass('is-invalid');
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
