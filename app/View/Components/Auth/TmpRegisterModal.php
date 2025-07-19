<?php

namespace App\View\Components\Auth;

use Illuminate\View\Component;

class TmpRegisterModal extends Component
{
    public $mainCategory;       // メインカテゴリー
    public $subCategories;      // サブカテゴリー

    /**
     * クラスを初期化する
     */
    public function __construct()
    {
        // メインカテゴリーの設定を行う
        $this->mainCategory = ['title' => 'アカウント仮登録', 'id' => 'tmp-register-modal', 'form' => 'tmp-register-form'];

        // サブカテゴリーを単体で取得する
        $userId = $this->setSubCategorie('text', 'tmp_register_user_id', 'tmp_register_user_id_error', 'ユーザーID');
        $password = $this->setSubCategorie('text', 'tmp_register_email', 'tmp_register_email_error', 'パスワード');

        //サブカテゴリ―を結合する
        $this->subCategories = [$userId, $password];
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
