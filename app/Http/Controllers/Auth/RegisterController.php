<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Mail\SendRegisterMail;
use App\Models\TmpUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * モデルのインスタンスを作成する
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * ユーザー登録を行う
     * @param Object ユーザー登録情報
     */
    public function register(RegisterFormRequest $request): void
    {
        //ユーザーIDを取得する
        $userId = $request->register_user_id;

        //メールアドレスを取得する
        $email = $request->register_email;

        //ワンタイムパスワードを取得する
        $onetimePassword = $request->register_onetime_password;

        //パスワードを発行する
        $password = $this->getPassword(25);

        //アカウント情報を登録する
        $user = new User;
        $user->user_id = $userId;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->created_at = now();
        $user->updated_at = now();
        $user->created_user = 1;
        $user->updated_user = 1;
        $user->save();

        //仮アカウント情報を削除する
        TmpUser::where('user_id', $userId)
            ->where('email', $email)
            ->where('password', $onetimePassword)
            ->delete();

        //メールを送信する
        Mail::to($email)->send(new SendRegisterMail($userId, $password));
    }
}
