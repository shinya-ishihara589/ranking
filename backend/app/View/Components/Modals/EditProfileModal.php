<?php

namespace App\View\Components\Modals;

use App\View\Components\Modals\BaseModal;

/**
 * 項目登録
 */
final class EditProfileModal extends BaseModal
{
    /**
     * クラスを初期化する
     */
    public function __construct(int $userId)
    {
        // メインカテゴリーの設定を行う
        $this->mainCategory = ['title' => 'プロフィール更新', 'id' => 'edit-profile-modal', 'form' => 'edit-profile-form'];

        // サブカテゴリーを単体で設定値を取得する
        $profileName = $this->setSubCategorie('text', 'edit_profile_name', 'edit_profile_name_error', '名前');
        $profileSelfIntroduction = $this->setSubCategorie('textarea', 'edit_profile_self_introduction', 'edit_profile_self_introduction_error', '自己紹介');

        // サブカテゴリ―を結合する
        $this->subCategories = [$profileName, $profileSelfIntroduction];

        // 閉じるボタンを取得する
        $this->closeButton = ['name' => '閉じる'];

        // 閉じるボタンを取得する
        $this->actionButton = ['name' => '更新', 'url' => "/profile/{$userId}"];
    }
}
