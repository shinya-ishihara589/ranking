<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

abstract class BaseModal extends Component
{
    public $mainCategory;       // メインカテゴリー
    public $subCategories;      // サブカテゴリー
    public $closeButton;        // 閉じるボタン
    public $actionButton;       // アクションボタン

    /**
     * サブカテゴリ―を単体で設定する
     * @param String HTMLのtype
     * @param String HTMLのnameとID
     * @param String エラーメッセージのID
     * @param String プレイスフォルダー
     * @return Array サブカテゴリーの単体
     */
    protected function setSubCategorie(string $type, string $name, string $error, string $placeholder): array
    {
        return ['type' => $type, 'name' => $name, 'error' => $error, 'placeholder' => $placeholder];
    }

    /**
     * コンポーネントを呼び出す
     */
    public function render(): object
    {
        return view('components.modal');
    }
}
