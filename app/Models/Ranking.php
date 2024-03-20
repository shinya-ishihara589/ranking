<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Ranking extends Model
{
    use HasFactory;

    private $searchWords;   //あいまい検索ワード
    private $mode;          //画面の種類
    private $limit;         //取得開始数
    private $itemId;        //項目ID
    private $userId;        //ユーザーID

    /**
     * コンストラクタ
     * @param String あいまい検索ワード
     * @param Integer 取得開始数
     * @param String ユーザーID
     */
    function __construct(string $words = null, string $mode, int $itemId = null, int $limit = 10)
    {
        //全角スペースを半角スペースに置換する
        $words = str_replace([' ', '　'], ' ', $words);

        //半角スペース区切りで配列を作る
        $words = explode(' ', $words);

        //あいまい検索用のワードを生成する
        $searchWords = [];
        foreach ($words as $word) {
            //ワードが空文字でない場合は検索ワードを追加する
            if ($word !== '') {
                $searchWords[] = $word;
            }
        }

        //画面の

        $this->searchWords = $searchWords;
        $this->limit = $limit;
        $this->mode = $mode;
        $this->itemId = $itemId;
        $this->userId = Auth::id();
    }

    /**
     * 項目IDからランキング情報を取得する
     * @return Object ランキング情報
     */
    public function getRankingData(): object
    {
        $rankingQuery = Item::withCount(['votes' => function ($query) {
            $query->select(DB::raw("COUNT(*)"));
        }]);

        //あいまい検索をする
        $rankingQuery->when($this->searchWords, function ($query) {
            $query->whereIn('name', $this->searchWords);
        });

        $rankingQuery
            ->where('item_id', $this->itemId)
            ->limit($this->limit)
            ->orderBy('votes_count', 'DESC');

        return $rankingQuery->get();
    }

    /**
     * 項目IDから全ての親項目を取得する
     * @return Array 項目IDに紐づく全ての親項目
     */
    public function getBreadcrumbs(): array
    {
        //項目情報を取得する
        $item = Item::with(['item'])->find($this->itemId);

        //パンくずリストを生成する
        $breadcrumbs = [];
        while (!empty($item)) {
            isset($item->name) ? $breadcrumbs[] = ['id' => $item->id, 'name' => $item->name] : '';
            $item = isset($item->item) ? $item->item : '';
        }
        return $breadcrumbs;
    }

    /**
     * 項目IDから項目に紐づく投票数の合計を取得する
     * @param BigInteger 項目ID
     * @return Integer 投票数の合計(votes_count)
     */
    public function getItemData($itemId)
    {
        $rankingQuery = Item::withCount(['votes' => function ($query) {
            $query->select(DB::raw("COUNT(*)"));
        }]);
        return $rankingQuery->where('id', $itemId)->first();
    }
}
