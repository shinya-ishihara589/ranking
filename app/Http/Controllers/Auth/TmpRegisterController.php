<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TmpRegisterFormRequest;
use App\Mail\SendTmpRegisterMail;
use App\Models\TmpUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;

class TmpRegisterController extends Controller
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
     * 仮ユーザー登録を行う
     * @param Object 仮ユーザー登録情報
     */
    public function tmpRegister(TmpRegisterFormRequest $request): void
    {
        //ユーザーIDを取得する
        $userId = $request->tmp_register_user_id;

        //メールアドレスを取得する
        $email = $request->tmp_register_email;

        //パスワードを発行する
        $password = $this->getPassword(15);

        //仮ユーザー情報を登録する
        $onetime = TmpUser::firstOrNew(['email' => $email]);
        $onetime->user_id = $userId;
        $onetime->email = $email;
        $onetime->password = $password;
        $onetime->ip = $request->ip();
        $onetime->save();

        //メールを送信する
        Mail::to($email)->send(new SendTmpRegisterMail($password));
    }
}
