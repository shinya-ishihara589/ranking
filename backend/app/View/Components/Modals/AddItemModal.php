<?php

namespace App\View\Components\Modals;

use App\View\Components\Modals\BaseModal;

/**
 * 項目登録
 */
final class AddItemModal extends BaseModal
{
    /**
     * クラスを初期化する
     */
    public function __construct(?string $id)
    {
        // メインカテゴリーの設定を行う
        $this->mainCategory = ['title' => '項目追加', 'id' => 'add-item-modal', 'form' => 'add-item-form'];

        // サブカテゴリーを単体で設定値を取得する
        $tmpUserId = $this->setSubCategorie('text', 'tmp_register_user_id', 'tmp_register_user_id_error', '項目名');

        // サブカテゴリ―を結合する
        $this->subCategories = [$tmpUserId];

        // 閉じるボタンを取得する
        $this->closeButton = ['name' => '閉じる'];

        // 閉じるボタンを取得する
        $this->actionButton = ['name' => '追加', 'url' => "//{$id}"];
    }
}
