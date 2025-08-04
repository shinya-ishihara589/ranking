<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    /**
     * ユーザー画面に遷移する
     * @param Request 検索条件
     */
    public function index(Request $request)
    {
        //ユーザー情報を取得する
        $userData = User::find(Auth::id());

        return view('setting.index', compact(['userData']));
    }

    /**
     * ユーザー情報を更新する
     * @param Request 検索条件
     */
    public function update(Request $request)
    {
        //ユーザー情報を取得する
        $userData = User::find(Auth::id());

        //ユーザー情報を更新する
        $userData->email = $request->email;
        $userData->save();

        return view('setting.index', compact(['userData']));
    }
}
