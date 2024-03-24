<?php

namespace App\Models;

use App\Models\Friend;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model
{
    use HasFactory;

    /**
     * 検索ワードを文字列で取得する
     * @param String 検索ワード
     * @return String 検索ワード
     */
    protected function getSearchWordsString(string $words = null): string
    {
        //全角スペースを半角スペースに置換する
        $words = str_replace([' ', '　'], ' ', $words);

        //半角スペース区切りで配列を作る
        $words = explode(' ', $words);

        //あいまい検索用のワードを生成する
        $searchWords = '';
        foreach ($words as $no => $word) {
            //ワードが空文字でない場合は検索ワードを追加する
            if ($word !== '') {
                $searchWords .= "^.*{$word}.*";
            }
            //ワードが最後の配列でない場合は「,」を追加する
            if (count($words) !== ($no + 1)) {
                $searchWords .= "|";
            }
        }
        return $searchWords;
    }

    /**
     * 検索ワードを配列で取得する
     * @param String 検索ワード
     * @return Array 検索ワード
     */
    protected function getSearchWordsArray(string $words = null): array
    {
        //あいまい検索用のワードを生成する
        $searchWords = [];

        //全角スペースを半角スペースに置換する
        $words = str_replace([' ', '　'], ' ', $words);

        //半角スペース区切りで配列を作る
        $words = explode(' ', $words);

        foreach ($words as $word) {
            //ワードが空文字でない場合は検索ワードを追加する
            if ($word !== '') {
                $searchWords[] = $word;
            }
        }
        return $searchWords;
    }

    /**
     * ホーム画面のユーザーIDを文字列で取得する
     * @return String ホーム画面のユーザーID
     */
    protected function getHomeIdsString(): string
    {
        //フレンドIDを取得する
        $friends = Friend::where('user_id', Auth::id())->get();

        //ホーム画面のユーザーIDを生成する
        $homeIds = Auth::id();
        foreach ($friends as $friend) {
            $homeIds .= ",{$friend->friend_id}";
        }
        return $homeIds;
    }

    /**
     * ホーム画面のユーザーIDを文字列で取得する
     * @return Array ホーム画面のユーザーID
     */
    protected function getHomeIdsArray(): array
    {
        //フレンドIDを取得する
        $friends = Friend::where('user_id', Auth::id())->get();

        //ホーム画面のユーザーIDを生成する
        $homeIds = Auth::id() + $friends;

        return $homeIds;
    }

    /**
     * 取得上限数を取得する
     * @param Integer 取得上限数
     * @return Integer 取得上限数
     */
    protected function getSearchLimit(int $limit = null): int
    {
        //取得上限数を初期化する
        $searchLimit = 0;

        //1.取得上限数が「null」の場合は「10」を取得する
        //2.取得上限数に値が入っている場合は指定した取得上限数を取得する
        if ($limit === null) {
            $searchLimit = 10;
        } else if ($limit) {
            $searchLimit = $limit;
        }
        return $searchLimit;
    }
}
