<?php

namespace App\View\Components\Modals;

use App\View\Components\Modals\BaseModal;

/**
 * アカウント登録
 */
final class RegisterModal extends BaseModal
{
    /**
     * クラスを初期化する
     */
    public function __construct()
    {
        // メインカテゴリーの設定を行う
        $this->mainCategory = ['title' => 'アカウント登録', 'id' => 'register-modal', 'form' => 'register-form'];

        // サブカテゴリーを単体で設定値を取得する
        $userId = $this->setSubCategorie('hidden', 'register_user_id', '', '');
        $email = $this->setSubCategorie('hidden', 'register_email', '', '');
        $registerOnetimePassword = $this->setSubCategorie('text', 'register_onetime_password', 'register_onetime_password_error', 'ワンタイムパスワード');

        // サブカテゴリ―を結合する
        $this->subCategories = [$userId, $email, $registerOnetimePassword];

        // 閉じるボタンを取得する
        $this->closeButton = ['name' => '閉じる'];

        // アクションボタンを取得する
        $this->actionButton = ['name' => '登録', 'url' => '/register'];
    }
}
