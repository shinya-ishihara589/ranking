/**
 * オーバーレイをONにする
 */
function onOverlay() {
    //画面をクリックできなくする
    $('html').css('pointer-events', 'none');

    //ロードアイコンを表示する
    $('#orverlay').removeClass('d-none');
}

/**
 * オーバーレイをOFFにする
 */
function offOverlay() {
    //画面をクリックできるようにする
    $('html').css('pointer-events', 'auto');

    //ロードアイコンを表示する
    $('#orverlay').addClass('d-none');
}
