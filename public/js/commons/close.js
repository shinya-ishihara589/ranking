/**
 * 閉じるボタンをクリックした場合の処理を実行する
 */
function clickCloseButton(formName) {
    //入力欄を初期化する
    resetInput(formName);

    //エラーメッセージを非表示にする
    hideErrorMeaage();
}
