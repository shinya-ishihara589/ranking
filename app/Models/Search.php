<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Search extends BaseModel
{
    use HasFactory;

    private $searchWords;   //あいまい検索ワード
    private $offset;        //取得開始数
    private $userId;        //ユーザーID

    /**
     * コンストラクタ
     * @param String あいまい検索ワード
     * @param String 画面の種類
     * @param Integer 取得開始数
     */
    function __construct(object $request)
    {
        //メンバ変数に値を入れる
        $this->searchWords = $this->getSearchWordsString($request->words);
        $this->offset = ($request->offset) ? $request->offset : 0;
        $this->userId = Auth::id();
    }

    /**
     * ホーム情報を取得する
     * @return Database ホーム情報
     */
    public function getSearchData(): array
    {
        //ホームで使用する情報のSQLを生成する
        $sql = "SELECT * FROM ( ";
        $sql .= $this->getSqlVotesTable() . "UNION";
        $sql .= $this->getSqlCommentsTable() . "UNION";
        $sql .= $this->getSqlDiscussionsTable();
        $sql .= " ) AS hone_data ORDER BY datetime DESC LIMIT 10 OFFSET $this->offset;";

        return DB::select($sql);
    }

    /**
     * ホーム情報(投票)のSQLを取得する
     * @return String ホーム情報(投票)のSQL
     */
    private function getSqlVotesTable(): string
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
                items.user_id = $this->userId
            AND
                items.id IS NOT NULL";

        if (!empty($this->searchWords)) {
            $sql .= " AND items.name REGEXP'($this->searchWords)'";
        }

        $sql .= ')';

        return $sql;
    }

    /**
     * ホーム情報(コメント)のSQLを取得する
     * @return String ホーム情報(コメント)のSQL
     */
    private function getSqlCommentsTable(): string
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
                user_id = $this->userId";

        if (!empty($this->searchWords)) {
            $sql .= " AND comments.comment REGEXP'($this->searchWords)'";
        }

        $sql .= ')';

        return $sql;
    }

    /**
     * ホーム情報(議論)のSQLを取得する
     * @return String ホーム情報(議論)のSQL
     */
    private function getSqlDiscussionsTable(): string
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
                items.user_id = $this->userId
            AND
                items.id IS NOT NULL";

        if (!empty($this->searchWords)) {
            $sql .= " AND items.name REGEXP'($this->searchWords)' OR discussions.text REGEXP'($this->searchWords)'";
        }

        $sql .= ')';

        return $sql;
    }
}
