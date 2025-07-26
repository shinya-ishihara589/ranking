<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    public $view_name;      // 画面名
    public $item_id;        // 項目ID
    public $search_state;   // 検索ステータス

    /**
     * クラスを初期化する
     * @param String $viewName 画面名
     * @param Integer ?$itemId 項目ID
     */
    public function __construct(string $viewName, ?int $itemId = null)
    {
        $this->view_name = $viewName;   // 画面名を設定する
        $this->item_id = $itemId;       // 項目IDを設定する

        // 画面名に応じて検索ステータスを設定する
        switch ($viewName) {
            case 'search.index':
                $this->search_state = 1;
                break;
            case 'home.index':
                $this->search_state = 2;
                break;
            case 'ranking.index':
                $this->search_state = 3;
                break;
            default:
                $this->search_state = 0;
                break;
        }
    }

    /**
     * コンポーネントを呼び出す
     */
    public function render()
    {
        return view('components.header');
    }
}
