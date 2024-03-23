/**
 * 入力欄を初期化する
 */
function resetInput(formName) {
    //フォーム情報を取得する
    let form = $(`#${formName}`);
    let params = form.serializeArray();

    //入力欄を初期化する
    for (var key in params) {
        $(`#${params[key]['name']}`).val('');
    }
}
