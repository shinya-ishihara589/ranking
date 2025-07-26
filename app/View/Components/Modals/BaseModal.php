<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

abstract class BaseModal extends Component
{
    protected $mainCategory;    // メインカテゴリー
    protected $subCategories;   // サブカテゴリー
    protected $closeButton;     // 閉じるボタン
    protected $actionButton;    // アクションボタン

    /**
     * クラスを初期化する
     */
    protected function __construct() {}

    /**
     * サブカテゴリ―を単体で設定する
     * @param String HTMLのtype
     * @param String HTMLのnameとID
     * @param String エラーメッセージのID
     * @param String プレイスフォルダー
     * @return Array サブカテゴリーの単体
     */
    protected function setSubCategorie(string $type, string $name, string $error, string $placeholder)
    {
        return ['type' => $type, 'name' => $name, 'error' => $error, 'placeholder' => $placeholder];
    }

    /**
     * コンポーネントを呼び出す
     */
    public function render()
    {
        return view('components.modal');
    }
}
