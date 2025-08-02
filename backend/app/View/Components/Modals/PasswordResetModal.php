<?php

namespace App\View\Components\Modals;

use App\View\Components\Modals\BaseModal;

final class PasswordResetModal extends BaseModal
{
    /**
     * クラスを初期化する
     */
    public function __construct()
    {
        // メインカテゴリーの設定を行う
        $this->mainCategory = ['title' => 'アカウント仮登録', 'id' => 'register-modal', 'form' => 'register-form'];

        // サブカテゴリーを単体で設定値を取得する
        $userId = $this->setSubCategorie('text', 'register_user_id', 'register_user_id_error', 'ユーザーID');
        $password = $this->setSubCategorie('text', 'register_email', 'register_email_error', 'パスワード');

        // サブカテゴリ―を結合する
        $this->subCategories = [$userId, $password];

        // 閉じるボタンを取得する
        $this->closeButton = ['name' => '閉じる'];

        // アクションボタンを取得する
        $this->actionButton = ['name' => 'パスワード再発行', 'url' => '/password_reset'];
    }
}
