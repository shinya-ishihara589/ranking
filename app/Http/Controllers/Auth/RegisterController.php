<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOnetimePasswordMail;
use App\Models\TmpUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        //ユーザー情報を登録する
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * ユーザー仮登録を行う
     * @param Object ユーザー仮登録情報
     */
    public function tmpRegister(Request $request): void
    {
        //メールアドレスを取得する
        $tmpUserId = $request->tmp_user_id;

        //メールアドレスを取得する
        $tmpEmail = $request->tmp_email;

        //ワンタイムパスワードを発行する
        $onetimePassword = $this->getPassword(15);

        //ワンタイム情報を登録する
        $onetime = TmpUser::firstOrNew(['tmp_email' => $tmpEmail]);
        $onetime->tmp_user_id = $tmpUserId;
        $onetime->tmp_email = $tmpEmail;
        $onetime->onetime_password = $onetimePassword;
        $onetime->ip = $request->ip();
        $onetime->save();

        //メールを送信する
        Mail::to($tmpEmail)->send(new SendOnetimePasswordMail($onetimePassword));
    }

    /**
     * アカウント情報を登録する
     * @param Object 登録情報
     */
    public function register(Request $request): void
    {
        //ユーザーIDを取得する
        $userId = $request->user_id;

        //メールアドレスを取得する
        $email = $request->email;

        //ワンタイムパスワードを取得する
        $onetimePassword = $request->email;

        // $tmpUser = TmpUser::where('tmp_user_id', $userId)->where('tmp_email', $email)->where('onetime_password', $onetimePassword);

        //パスワードを発行する
        $password = $this->getPassword(25);

        //アカウント情報を登録する
        $tmpUser = new User;
        $tmpUser->user_id = $userId;
        $tmpUser->email = $email;
        $tmpUser->password = bcrypt($password);
        $tmpUser->created_user = 1;
        $tmpUser->save();

        //メールを送信する
        Mail::to($email)->send(new SendOnetimePasswordMail($password));
    }
}
