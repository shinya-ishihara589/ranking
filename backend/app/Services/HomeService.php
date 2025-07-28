<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeService extends BaseService
{
    private $homeIds;       // フレンドID
    private $iconPath;      // アイコンパス
    private $iconNullPath;  // アイコンパス無しの場合の画像URL

    /**
     * クラスを初期化する
     */
    function __construct()
    {
        $this->homeIds = $this->getHomeIdsString();         // フレンドIDの取得
        $this->iconPath = asset('storage/users/');          // アインパスの取得
        $this->iconNullPath = config('app.icon_null_path'); // アイコンパス無しの場合の画像URLを取得
    }

    /**
     * ホーム画面に使用する情報を取得する
     * @param Object $request 検索情報
     * @return Array $homeData ホーム情報
     */
    public function getHomeData(Request $request): array
    {
        // 検索ワードを取得する
        $searchWords = $this->getSearchWordsString($request->words);

        // 取得するホーム情報の種類を設定する
        $mode = $request->mode;

        // 取得するホーム情報の数を設定する
        $offset = ($request->offset) ? $request->offset : 0;

        // ホームで使用する情報のSQLを生成する
        $sql = "SELECT * FROM ( ";

        // 1.検索モードが「vote」の場合は投票の検索結果のSQL文を取得する
        // 2.検索モードが「comment」の場合はコメントの検索結果のSQL文を取得する
        // 3.検索モードが「discussion」の場合は議論の検索結果のSQL文を取得する
        // 4.上記以外の場合は総合の検索結果のSQL文を取得する
        if ($mode == 'vote') {
            $sql .= $this->getSqlVotesTable($this->iconNullPath, $this->iconPath, $this->homeIds, $searchWords);
        } else if ($mode == 'comment') {
            $sql .= $this->getSqlCommentsTable($this->iconNullPath, $this->iconPath, $this->homeIds, $searchWords);
        } else if ($mode == 'discussion') {
            $sql .= $this->getSqlDiscussionsTable($this->iconNullPath, $this->iconPath, $this->homeIds, $searchWords);
        } else {
            $sql .= $this->getSqlVotesTable($this->iconNullPath, $this->iconPath, $this->homeIds, $searchWords) . "UNION";
            $sql .= $this->getSqlCommentsTable($this->iconNullPath, $this->iconPath, $this->homeIds, $searchWords) . "UNION";
            $sql .= $this->getSqlDiscussionsTable($this->iconNullPath, $this->iconPath, $this->homeIds, $searchWords);
        }

        $sql .= " ) AS datetime ORDER BY datetime DESC LIMIT 10 OFFSET $offset;";

        // ホーム画面に使用する情報を取得する
        $homeData = DB::select($sql);

        return $homeData;
    }

    /**
     * ホーム情報(投票)のSQLを取得する
     * @param String $iconNullPath ユーザーのアイコンが無い場合のアイコンのURL
     * @param String $iconPath ユーザーのアイコンの格納場所
     * @param String $searchWords 検索情報
     * @return String $sql ホーム情報(投票)のSQL
     */
    private function getSqlVotesTable(string $iconNullPath, string $iconPath, string $homeIds, string $searchWords): string
    {
        $sql = "
            (SELECT
                'vote' AS home,
                'bi bi-chat-right-heart' AS action_icon,
                CASE
                    WHEN profiles.icon_path IS NULL THEN '$iconNullPath'
                    ELSE CONCAT('$iconPath', '/', users.user_id, '/', profiles.icon_path)
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
            WHERE votes.user_id IN($homeIds) AND items.id IS NOT NULL";

        if (!empty($searchWords)) {
            $sql .= " AND items.name REGEXP'($searchWords)'";
        }

        $sql .= ')';

        return $sql;
    }

    /**
     * ホーム情報(コメント)のSQLを取得する
     * @param String $iconNullPath ユーザーのアイコンが無い場合のアイコンのURL
     * @param String $iconPath ユーザーのアイコンの格納場所
     * @param String $searchWords 検索情報
     * @return String $sql ホーム情報(投票)のSQL
     */
    private function getSqlCommentsTable(string $iconNullPath, string $iconPath, string $homeIds, string $searchWords): string
    {
        $sql = "
            (SELECT
                'comment' AS home,
                'bi bi-chat-right-text' AS action_icon,
                CASE
                    WHEN profiles.icon_path IS NULL THEN '$iconNullPath'
                    ELSE CONCAT('$iconPath', '/', users.user_id, '/', profiles.icon_path)
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
            WHERE comments.user_id IN($homeIds)";

        if (!empty($searchWords)) {
            $sql .= " AND comments.comment REGEXP'($searchWords)'";
        }

        $sql .= ')';

        return $sql;
    }

    /**
     * ホーム情報(議論)のSQLを取得する
     * @param String $iconNullPath ユーザーのアイコンが無い場合のアイコンのURL
     * @param String $iconPath ユーザーのアイコンの格納場所
     * @param String $searchWords 検索情報
     * @return String $sql ホーム情報(投票)のSQL
     */
    private function getSqlDiscussionsTable(string $iconNullPath, string $iconPath, string $homeIds, string $searchWords): string
    {
        $sql = "
            (SELECT
                'discussion' AS home,
                'bi bi-arrows-move' AS action_icon,
                CASE
                    WHEN profiles.icon_path IS NULL THEN '$iconNullPath'
                    ELSE CONCAT('$iconPath', '/', users.user_id, '/', profiles.icon_path)
                END AS profiles_icon_path,
                CASE
                    WHEN profiles.name IS NULL THEN users.user_id
                    ELSE profiles.name
                END AS profiles_name,
                users.user_id AS users_user_id,
                CONCAT('<a href=/discussions/', items.id, '>', items.name, '</a><br>', comments.comment) AS content,
                discussions.datetime AS datetime
            FROM discussions
            LEFT JOIN items ON discussions.item_id = items.id
            LEFT JOIN users ON discussions.user_id = users.id
            LEFT JOIN profiles ON discussions.user_id = profiles.user_id
            LEFT JOIN comments ON discussions.user_id = comments.user_id
            WHERE comments.user_id IN($homeIds) AND items.id IS NOT NULL";

        if (!empty($searchWords)) {
            $sql .= " AND items.name REGEXP'($searchWords)' OR discussions.text REGEXP'($searchWords)'";
        }

        $sql .= ')';

        return $sql;
    }
}
