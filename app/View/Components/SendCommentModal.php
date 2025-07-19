<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SendCommentModal extends Component
{
    public $mainCategory;       // メインカテゴリー
    public $subCategories;      // サブカテゴリー

    /**
     * クラスを初期化する
     */
    public function __construct()
    {
        // メインカテゴリーの設定を行う
        $this->mainCategory = ['title' => 'コメント', 'id' => 'send-comment-modal', 'form' => 'send-comment-form'];

        // サブカテゴリーを単体で取得する
        $comment = $this->setSubCategorie('textarea', 'send_comment_comment', 'send_comment_comment_error', 'コメント');

        //サブカテゴリ―を結合する
        $this->subCategories = [$comment];
    }

    /**
     * サブカテゴリ―を単体で設定する
     * @param String HTMLのtype
     * @param String HTMLのnameとID
     * @param String エラーメッセージのID
     * @param String プレイスフォルダー
     * @return Array サブカテゴリーの単体
     */
    private function setSubCategorie($type, $name, $error, $placeholder)
    {
        return ['type' => $type, 'name' => $name, 'error' => '$error', 'placeholder' => $placeholder];
    }

    /**
     * コンポーネントを呼び出す
     */
    public function render()
    {
        return view('components.modal');
    }
}
