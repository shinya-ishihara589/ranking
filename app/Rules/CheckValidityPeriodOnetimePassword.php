<?php

namespace App\Rules;

use App\Models\TmpUser;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckValidityPeriodOnetimePassword implements ValidationRule
{
    private $userId;    //ユーザーID
    private $email;     //メールアドレス

    /**
     * コンストラクタ
     * @param String ユーザーID
     * @param String メールアドレス
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
        //現在の時間を取得する
        $nowDateTime = Carbon::now();

        //1時間前を取得する
        $atHourAgo = $nowDateTime->subHour()->format('Y-m-d H:i:s');

        //仮登録ユーザーを取得する
        $tmpUserExists = TmpUser::where('user_id', $this->userId)
            ->where('email', $this->email)
            ->where('password', $value)
            ->where('datetime', '>=', $atHourAgo)
            ->exists();

        //仮ユーザー情報が存在しない場合はエラーメッセージを返す
        if (!$tmpUserExists) {
            $fail(':attributeの有効期限が切れています。');
        }
    }
}
