<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
