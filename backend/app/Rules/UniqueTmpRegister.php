<?php

namespace App\Rules;

use App\Models\TmpUser;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;


class UniqueTmpRegister implements ValidationRule
{
    private $column;    //カラム名

    /**
     * コンストラクタ
     * @param String 検索するカラム名
     */
    public function __construct(string $column)
    {
        $this->column = $column;
    }

    /**
     * 仮登録ユーザーに1時間以内に同一の仮ユーザー情報が登録されているか確認する
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
        $tmpUserExists = TmpUser::where($this->column, $value)->where('datetime', '>=', $atHourAgo)->exists();

        //仮ユーザー情報が存在する場合はエラーメッセージを返す
        if ($tmpUserExists) {
            $fail('指定の:attributeは既に仮登録に使用されています。');
        }
    }
}
