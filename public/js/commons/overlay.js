/**
 * オーバーレイをONにする
 */
function onOverlay() {
    //画面をクリックできなくする
    $('div').css('pointer-events', 'none');

    //ロードアイコンを表示する
    $('#orverlay').removeClass('d-none');
}

/**
 * オーバーレイをOFFにする
 */
function offOverlay() {
    //画面をクリックできるようにする
    $('div').css('pointer-events', 'auto');

    //ロードアイコンを非表示にする
    $('#orverlay').addClass('d-none');
}
