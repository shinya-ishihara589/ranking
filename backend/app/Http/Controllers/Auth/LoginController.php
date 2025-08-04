<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    /**
     * ログイン処理を行う
     * @param Object $request ログイン情報
     * @return Object ホーム画面 又は ログイン画面
     */
    public function showLoginForm(): object
    {
        return view('auth.login');
    }

    /**
     * ログイン処理を行う
     * @param Object $request ログイン情報
     * @return Object ホーム画面 又は ログイン画面
     */
    public function login(LoginFormRequest $request): object
    {
        // ログイン情報を取得する
        $credentials = $request->only('email', 'password');

        // ログインが正常に行われた場合はホーム画面に遷移する
        if (Auth::attempt($credentials)) {
            // セッション処理を登録する
            $this->storeSessionLog($request, 'LOGIN');
            return redirect('');
        }
        return redirect('/login');
    }
}
