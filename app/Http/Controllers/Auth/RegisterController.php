<?php

namespace App\Http\Controllers\Auth;

use App\Mail\SendTmpRegisterMail;
use App\Models\TmpUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends AuthController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);
    }

    /**
     * アカウント情報を登録する
     * @param Array 登録情報
     */
    protected function create(array $data)
    {

        //ユーザーIDを取得する
        $userId = $data['user_id'];

        //メールアドレスを取得する
        $email = $data['email'];

        //ワンタイムパスワードを取得する
        $onetimePassword = $data['password'];

        $tmpUser = TmpUser::where('user_id', $userId)->where('email', $email)->where('password', $onetimePassword);

        //パスワードを発行する
        $password = $this->getPassword(25);

        //アカウント情報を登録する
        return User::create([
            'user_id' => $userId,
            'email' => $email,
            'password' => Hash::make($password),
            'created_user' => 1,
        ]);

        //メールを送信する
        Mail::to($email)->send(new SendTmpRegisterMail($password));
    }

    /**
     * 仮ユーザー登録を行う
     * @param Object 仮ユーザー登録情報
     */
    public function tmpRegister(Request $request): void
    {
        //バリデーションチェックを行う
        $request->validate([
            'user_id' => $this->getUserIdValidate($request),
            'email' => $this->getMailValidate($request),
        ]);

        //メールアドレスを取得する
        $userId = $request->user_id;

        //メールアドレスを取得する
        $email = $request->email;

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
