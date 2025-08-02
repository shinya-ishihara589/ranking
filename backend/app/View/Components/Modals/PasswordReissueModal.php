<?php

namespace App\View\Components\Modals;

use App\View\Components\Modals\BaseModal;

/**
 * パスワード再発行
 */
final class PasswordReissueModal extends BaseModal
{
    /**
     * クラスを初期化する
     */
    public function __construct()
    {
        // メインカテゴリーの設定を行う
        $this->mainCategory = ['title' => 'アカウント登録', 'id' => 'register-modal', 'form' => 'tegister-form'];

        // サブカテゴリーを単体で設定値を取得する
        $userId = $this->setSubCategorie('text', 'password_reissue_user_id', 'password_reissue_user_id_error', 'ユーザーID');

        // サブカテゴリ―を結合する
        $this->subCategories = [$userId];

        // 閉じるボタンを取得する
        $this->closeButton = ['name' => '閉じる'];

        // アクションボタンを取得する
        $this->actionButton = ['name' => 'パスワード再発行', 'url' => '/register'];
    }
}
