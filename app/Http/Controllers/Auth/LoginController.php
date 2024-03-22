<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログイン処理を行う
     * @param Object ログイン情報
     * @return Object ホーム画面 又は ログイン画面
     */
    public function login(Request $request): object
    {
        //ログイン情報を取得する
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //ログインが正常に行われた場合はホーム画面に遷移する
        if (Auth::attempt($credentials)) {
            return redirect('');
        }
        return redirect('/login');
    }

    /**
     * ログアウト処理を行う
     * @return Object ログイン画面
     */
    public function logout(): object
    {
        //ログアウト処理を行う
        Auth::logout();
        return redirect('/login');
    }
}
