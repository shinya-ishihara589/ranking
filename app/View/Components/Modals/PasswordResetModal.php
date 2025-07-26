<?php

namespace App\View\Components\Modals;

use App\View\Components\Modals\BaseModal;

class PasswordResetModal extends BaseModal
{
    public $mainCategory;       // メインカテゴリー
    public $subCategories;      // サブカテゴリー
    public $closeButton;        // 閉じるボタン
    public $actionButton;       // アクションボタン

    /**
     * クラスを初期化する
     */
    public function __construct()
    {
        // メインカテゴリーの設定を行う
        $this->mainCategory = ['title' => 'アカウント仮登録', 'id' => 'tmp-register-modal', 'form' => 'tmp-register-form'];

        // サブカテゴリーを単体で設定値を取得する
        $userId = $this->setSubCategorie('text', 'tmp_register_user_id', 'tmp_register_user_id_error', 'ユーザーID');
        $password = $this->setSubCategorie('text', 'tmp_register_email', 'tmp_register_email_error', 'パスワード');

        //サブカテゴリ―を結合する
        $this->subCategories = [$userId, $password];

        // 閉じるボタンを取得する
        $this->closeButton = ['name' => '閉じる'];

        // アクションボタンを取得する
        $this->actionButton = ['name' => 'パスワード再発行', 'url' => '/password_reset'];
    }
}
