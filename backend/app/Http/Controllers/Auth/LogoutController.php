<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends BaseController
{
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
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
