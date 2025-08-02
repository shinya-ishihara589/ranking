<?php

namespace App\View\Components\Modals;

use App\View\Components\Modals\BaseModal;

/**
 * パスワード再発行用のモーダルコンポーネント。
 *
 * このクラスは、ユーザーがパスワードを忘れた場合に、ユーザーIDを入力してパスワード再発行をリクエストするためのモーダルUIを提供します。
 * ログインページの「パスワードを忘れた」リンクから呼び出され、ユーザーIDを入力するフォームを表示します。
 * フォーム送信後、指定されたURL（/reissue_password）にリクエストを送信し、パスワード再発行プロセスを開始します。
 *
 * @see BaseModal モーダルの基本機能を提供する親クラス
 * @property array $mainCategory モーダルの主要な設定（タイトル、ID、フォーム名）
 * @property array[] $subCategories サブカテゴリ（入力フィールド）の設定
 * @property array $closeButton 閉じるボタンの設定
 * @property array $actionButton アクションボタンの設定
 */
final class ReissuePasswordModal extends BaseModal
{
    private const MODAL_TITLE = 'アカウント登録';
    private const MODAL_ID = 'reset-password-modal';
    private const FORM_ID = 'reset-password-form';
    private const ACTION_URL = '/reissue_password';

    /**
     * コンストラクタ
     * モーダルの設定を初期化する
     */
    public function __construct()
    {
        // メインカテゴリーの設定を行う
        $this->mainCategory = ['title' => self::MODAL_TITLE, 'id' => self::MODAL_ID, 'form' => self::FORM_ID];

        // サブカテゴリーを単体で設定値を取得する
        $userId = $this->setSubCategorie('text', 'reissue_password_user_id', 'reissue_password_user_id_error', 'ユーザーID');

        // サブカテゴリ―を結合する
        $this->subCategories = [$userId];

        // 閉じるボタンを取得する
        $this->closeButton = ['name' => '閉じる'];

        // アクションボタンを取得する
        $this->actionButton = ['name' => 'パスワード再発行', 'url' => self::ACTION_URL];
    }
}
