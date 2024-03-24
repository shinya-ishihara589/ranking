<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Home extends BaseModel
{
    use HasFactory;

    private $searchWords;   //あいまい検索ワード
    private $mode;          //画面の種類
    private $offset;        //取得開始数
    private $homeIds;       //フレンドID
    private $iconPath;      //アイコンパス
    private $iconNullPath;  //アイコンパス無し

    /**
     * モデルのインスタンスを作成する
     * @param Object 検索情報
     */
    function __construct(object $request)
    {
        //メンバ変数に値を入れる
        $this->searchWords = $this->getSearchWordsString($request->words);
        $this->mode = $request->mode;
        $this->offset = ($request->offset) ? $request->offset : 0;
        $this->homeIds = $this->getHomeIdsString();
        $this->iconPath = asset('storage/users/');
        $this->iconNullPath = '//ssl.gstatic.com/accounts/ui/avatar_2x.png';
    }

    /**
     * ホーム情報を取得する
     * @return Database ホーム情報
     */
    public function getHomeData(): array
    {
        //ホームで使用する情報のSQLを生成する
        $sql = "SELECT * FROM ( ";

        //各画面のSQL文を取得する
        if ($this->mode == 'vote') {
            $sql .= $this->getSqlVotesTable();
        } else if ($this->mode == 'comment') {
            $sql .= $this->getSqlCommentsTable();
        } else if ($this->mode == 'discussion') {
            $sql .= $this->getSqlDiscussionsTable();
        } else {
            $sql .= $this->getSqlVotesTable() . "UNION";
            $sql .= $this->getSqlCommentsTable() . "UNION";
            $sql .= $this->getSqlDiscussionsTable();
        }

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
                'bi bi-chat-right-heart' AS action_icon,
                CASE
                    WHEN profiles.icon_path IS NULL THEN '$this->iconNullPath'
                    ELSE CONCAT('$this->iconPath', '/', users.user_id, '/', profiles.icon_path)
                END AS profiles_icon_path,
                CASE
                    WHEN profiles.name IS NULL THEN users.user_id
                    ELSE profiles.name
                END AS profiles_name,
                users.user_id AS users_user_id,
                CONCAT('<a href=/ranking/', items.id, '>', items.name, '</a>') AS content,
                votes.datetime AS datetime
            FROM votes
            LEFT JOIN items ON votes.item_id = items.id
            LEFT JOIN users ON votes.user_id = users.id
            LEFT JOIN profiles ON votes.user_id = profiles.user_id
            WHERE items.user_id IN($this->homeIds)
            AND items.id IS NOT NULL";

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
                'bi bi-chat-right-text' AS action_icon,
                CASE
                    WHEN profiles.icon_path IS NULL THEN '$this->iconNullPath'
                    ELSE CONCAT('$this->iconPath', '/', users.user_id, '/', profiles.icon_path)
                END AS profiles_icon_path,
                CASE
                    WHEN profiles.name IS NULL THEN users.user_id
                    ELSE profiles.name
                END AS profiles_name,
                users.user_id AS users_user_id,
                comments.comment AS content,
                comments.datetime AS datetime
            FROM comments
            LEFT JOIN users ON comments.user_id = users.id
            LEFT JOIN profiles ON comments.user_id = profiles.user_id
            WHERE comments.user_id IN($this->homeIds)";

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
                'bi bi-arrows-move' AS action_icon,
                CASE
                    WHEN profiles.icon_path IS NULL THEN '$this->iconNullPath'
                    ELSE CONCAT('$this->iconPath', '/', users.user_id, '/', profiles.icon_path)
                END AS profiles_icon_path,
                CASE
                    WHEN profiles.name IS NULL THEN users.user_id
                    ELSE profiles.name
                END AS profiles_name,
                users.user_id AS users_user_id,
                CONCAT(items.name, '<br>', comments.comment) AS content,
                discussions.datetime AS datetime
            FROM discussions
            LEFT JOIN items ON discussions.item_id = items.id
            LEFT JOIN users ON discussions.user_id = users.id
            LEFT JOIN profiles ON discussions.user_id = profiles.user_id
            LEFT JOIN comments ON discussions.user_id = comments.user_id
            WHERE items.user_id IN($this->homeIds)
            AND items.id IS NOT NULL";

        if (!empty($this->searchWords)) {
            $sql .= " AND items.name REGEXP'($this->searchWords)' OR discussions.text REGEXP'($this->searchWords)'";
        }

        $sql .= ')';

        return $sql;
    }
}
