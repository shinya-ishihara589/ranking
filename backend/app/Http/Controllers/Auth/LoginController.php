<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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

    /**
     * ログアウト処理を行う
     * @return Object $request ログイン画面
     */
    public function logout(Request $request): object
    {
        // セッション処理を登録する
        $this->storeSessionLog($request, 'LOGOUT');

        // ログアウト処理を行う
        Auth::logout();
        return redirect('/login');
    }
}
