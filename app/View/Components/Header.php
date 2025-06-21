<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    public $view_name;  // 画面名

    /**
     * クラスを初期化する
     * @param String $viewName 画面名
     */
    public function __construct($viewName)
    {
        // 画面名を設定する
        $this->view_name = $viewName;
    }

    /**
     * コンポーネントを呼び出す
     */
    public function render()
    {
        return view('components.header');
    }
}
