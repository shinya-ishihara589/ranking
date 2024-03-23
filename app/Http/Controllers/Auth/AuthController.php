<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * ユーザーIDの検証情報を取得する
     * @param Object 入力情報
     * @return Array 検証情報
     */

    protected function getUserIdValidate(object $request): array
    {
        return [
            'required',
            'max:255',
            Rule::unique('users')->where('user_id', $request->user_id),
        ];
    }

    /**
     * メールの検証情報を取得する
     * @param Object 入力情報
     * @return Array 検証情報
     */

    protected function getMailValidate(object $request): array
    {
        return [
            'required',
            'email',
            'max:255',
            Rule::unique('users')->where('email', $request->email),
        ];
    }
}
