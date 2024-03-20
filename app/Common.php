<?php

namespace App;

class Common
{
    /**
     * 申請内容を取得する
     * @return Array 申請内容
     */
    public static function getApplyTypes()
    {
        return [
            '1' => '修正',
            '2' => '移動',
            '3' => '削除',
            '99' => 'その他',
        ];
    }
}
