<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchService extends BaseService
{
    /**
     * 検索情報を取得する
     * @param Object $request 検索情報
     * @return Array $searchData 検索結果情報
     */
    public function getSearchData(Request $request): array
    {
        // ユーザーIDを取得する
        $userId = Auth::id();

        // 検索ワードを取得する
        $searchWords = $this->getSearchWordsString($request->words);

        // 取得するホーム情報の数を設定する
        $offset = ($request->offset) ? $request->offset : 0;

        //ホームで使用する情報のSQLを生成する
        $sql = "SELECT * FROM ( ";
        $sql .= $this->getSqlVotesTable($userId, $searchWords) . "UNION";
        $sql .= $this->getSqlCommentsTable($userId, $searchWords) . "UNION";
        $sql .= $this->getSqlDiscussionsTable($userId, $searchWords);
        $sql .= " ) AS hone_data ORDER BY datetime DESC LIMIT 10 OFFSET $offset;";

        // 検索結果情報を取得する
        $searchData = DB::select($sql);

        return $searchData;
    }

    /**
     * 検索情報(投票)のSQLを取得する
     * @param String $userId ユーザーID
     * @param String $searchWords 検索ワード
     * @return String 検索情報(投票)のSQL
     */
    private function getSqlVotesTable(string $userId, string $searchWords): string
    {
        $sql = "
            (SELECT
                'vote' AS home,
                null AS comment,
                votes.datetime,
                votes.id,
                votes.item_id,
                null AS parent_id,
                null AS status,
                null AS text,
                null AS type,
                votes.user_id,
                items.name
            FROM
                votes
            LEFT JOIN 
                items
            ON
                votes.item_id = items.id
            WHERE
                items.user_id = $userId
            AND
                items.id IS NOT NULL";

        if (!empty($searchWords)) {
            $sql .= " AND items.name REGEXP'($searchWords)'";
        }

        $sql .= ')';

        return $sql;
    }

    /**
     * 検索情報(コメント)のSQLを取得する
     * @param String $userId ユーザーID
     * @param String $searchWords 検索ワード
     * @return String 検索情報(コメント)のSQL
     */
    private function getSqlCommentsTable(string $userId, string $searchWords): string
    {
        $sql = "
            (SELECT
                'comment' AS home,
                comments.comment,
                comments.datetime,
                comments.id,
                null AS item_id,
                comments.parent_id,
                null AS status,
                null AS text,
                null AS type,
                comments.user_id,
                null AS name
            FROM
                comments
            WHERE
                user_id = $userId";

        if (!empty($searchWords)) {
            $sql .= " AND comments.comment REGEXP'($searchWords)'";
        }

        $sql .= ')';

        return $sql;
    }

    /**
     * 検索情報(議論)のSQLを取得する
     * @param String $userId ユーザーID
     * @param String $searchWords 検索ワード
     * @return String 検索情報(議論)のSQL
     */
    private function getSqlDiscussionsTable(string $userId, string $searchWords): string
    {
        $sql = "
            (SELECT
                'discussion' AS home,
                null AS comment,
                discussions.datetime,
                discussions.id,
                discussions.item_id,
                null AS parent_id,
                discussions.status,
                discussions.text,
                discussions.type,
                discussions.user_id,
                items.name
            FROM
                discussions
            LEFT JOIN
                items
            ON
                discussions.item_id = items.id
            WHERE
                items.user_id = $userId
            AND
                items.id IS NOT NULL";

        if (!empty($searchWords)) {
            $sql .= " AND items.name REGEXP'($searchWords)' OR discussions.text REGEXP'($searchWords)'";
        }

        $sql .= ')';

        return $sql;
    }
}
