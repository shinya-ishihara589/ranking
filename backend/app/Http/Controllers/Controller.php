<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * パスワードを生成する
     * @param Integer パスワードの文字数
     * @return String パスワード
     */
    protected function getPassword($num): string
    {
        //パスワードを生成する
        $password = Str::random($num);
        return $password;
    }
}
