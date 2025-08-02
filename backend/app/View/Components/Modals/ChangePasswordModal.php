<?php

namespace App\View\Components\Modals;

use App\View\Components\Modals\BaseModal;

final class ChangePasswordModal extends BaseModal
{
    /**
     * クラスを初期化する
     */
    public function __construct()
    {
        // メインカテゴリーの設定を行う
        $this->mainCategory = ['title' => 'パスワード変更', 'id' => 'change-password-modal', 'form' => 'change-password-form'];

        // サブカテゴリーを単体で設定値を取得する
        $userId = $this->setSubCategorie('text', 'change_password_user_id', 'change_password_user_id_error', 'ユーザーID');
        $email = $this->setSubCategorie('text', 'change_password_email', 'change_password_email_error', 'メールアドレス');
        $beforePassword = $this->setSubCategorie('text', 'change_password_email', 'change_password_email_error', '現在のパスワード');
        $afterPassword = $this->setSubCategorie('text', 'change_password_email', 'change_password_email_error', '変更パスワード');

        // サブカテゴリ―を結合する
        $this->subCategories = [$userId, $email, $beforePassword, $afterPassword];

        // 閉じるボタンを取得する
        $this->closeButton = ['name' => '閉じる'];

        // アクションボタンを取得する
        $this->actionButton = ['name' => 'パスワード再発行', 'url' => '/change_password'];
    }
}
