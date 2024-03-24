<?php

namespace App\Rules;

use App\Models\TmpUser;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckOnetimePassword implements ValidationRule
{
    private $userId;    //ユーザーID
    private $email;     //メールアドレス

    /**
     * コンストラクタ
     * @param String ユーザーID
     * @param String メールアドレス
     * @param String カラム名
     */
    public function __construct(string $userId, string $email)
    {
        $this->userId = $userId;
        $this->email = $email;
    }

    /**
     * 仮登録ユーザーのワンタイムパスワードが同一である事を確認する
     * @param String 項目名
     * @param Mixed 対象の値
     * @param Object エラーメッセージ
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //仮登録ユーザーを取得する
        $tmpUserExists = TmpUser::where('user_id', $this->userId)
            ->where('email', $this->email)
            ->where('password', $value)
            ->exists();

        //仮ユーザー情報が存在しない場合はエラーメッセージを返す
        if (!$tmpUserExists) {
            $fail(':attributeが一致しません。');
        }
    }
}
