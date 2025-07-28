<?php

namespace App\View\Components\Modals;

use App\View\Components\Modals\BaseModal;

class SendCommentModal extends BaseModal
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
        $this->mainCategory = ['title' => 'コメント', 'id' => 'send-comment-modal', 'form' => 'send-comment-form'];

        // サブカテゴリーを単体で取得する
        $comment = $this->setSubCategorie('textarea', 'send_comment_comment', 'send_comment_comment_error', 'コメント');

        // サブカテゴリ―を結合する
        $this->subCategories = [$comment];

        // 閉じるボタンの設定を行う
        $this->closeButton = ['name' => '閉じる'];

        // 送信ボタンの設定を行う
        $this->actionButton = ['name' => '送信', 'url' => '/comments/send/'];
    }
}
