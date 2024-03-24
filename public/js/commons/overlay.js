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
    //画面をクリックできるようにする
    $('div').css('pointer-events', 'auto');

    //ロードアイコンを非表示にする
    $('#overlay').addClass('d-none');
}
