<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    public $view_name;  // 画面名
    public $item_id;    // 項目ID

    /**
     * クラスを初期化する
     * @param String $viewName 画面名
     * @param Integer $itemId 項目ID
     */
    public function __construct(string $viewName, ?int $itemId = null)
    {
        $this->view_name = $viewName;   // 画面名を設定する
        $this->item_id = $itemId;       // 項目IDを設定する
    }

    /**
     * コンポーネントを呼び出す
     */
    public function render()
    {
        return view('components.header');
    }
}
