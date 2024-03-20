<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Ranking extends BaseModel
{
    use HasFactory;

    private $searchWords;   //あいまい検索ワード
    private $searchDate;    //検索期間
    private $offset;        //取得開始数
    private $limit;         //取得数
    private $itemId;        //項目ID

    /**
     * コンストラクタ
     * @param Object 検索情報
     * @param String 項目ID
     */
    function __construct(object $request, int $itemId = null)
    {
        $this->searchWords = $this->getSearchWordsArray($request->words);
        $this->searchDate = $this->getSearchDate($request->mode);
        $this->offset = ($request->offset) ? $request->offset : 0;
        $this->limit = $this->getSearchLimit($request->limit);
        $this->itemId = $itemId;
    }

    /**
     * 項目IDからランキング情報を取得する
     * @return Object ランキング情報
     */
    public function getRankingData(): object
    {
        //項目に紐づく投票数を取得する
        $rankingQuery = Item::withCount(['votes' => function ($query) {
            $query
                ->select(DB::raw("COUNT(*)"))
                ->when($this->searchDate, function ($query) {
                    $query->where('datetime', '>=', $this->searchDate);
                });
        }]);

        //あいまい検索をする
        $rankingQuery->when($this->searchWords, function ($query) {
            $query->whereIn('name', $this->searchWords);
        });

        $rankingQuery->where('item_id', $this->itemId)
            ->when($this->limit, function ($query) {
                $query->limit($this->limit);
            })->when($this->limit, function ($query) {
                $query->offset($this->offset);
            })->orderBy('votes_count', 'DESC');

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
     * @return Integer 投票数の合計(votes_count)
     */
    public function getItemData()
    {
        //項目に紐づく投票数を取得する
        $rankingQuery = Item::withCount(['votes' => function ($query) {
            $query
                ->select(DB::raw("COUNT(*)"))
                ->when($this->searchDate, function ($query) {
                    $query->where('datetime', '>=', $this->searchDate);
                });
        }]);
        return $rankingQuery->where('id', $this->itemId)->first();
    }

    /**
     * 検索期間を取得する
     * @param String 画面の種類
     * @return String 検索期間
     */
    private function getSearchDate(string $mode = null): string
    {
        //検索期間を初期化する
        $searchDate = '';

        //現在の日時を取得する
        $now = Carbon::now();

        //1.画面の種類が「yearly」の場合は「当年/1/1 00:00:00」を取得する
        //2.画面の種類が「monthly」の場合は「当年/当月/1 00:00:00」を取得する
        //3.画面の種類が「weekly」の場合は「当年/当月/1(日) 00:00:00」を取得する
        //4.画面の種類が「daily」の場合は「当年/当月/当日 00:00:00」を取得する
        if ($mode == 'yearly') {
            $searchDate = $now->format('Y/1/1 00:00:00');
        } else if ($mode == 'monthly') {
            $searchDate = $now->format('Y/m/1 00:00:00');
        } else if ($mode == 'weekly') {
            $day = $now->subDay($now->dayOfWeek);
            $searchDate = $now->format("Y/m/{$day} 00:00:00");
        } else if ($mode == 'daily') {
            $searchDate = $now->format('Y/m/d 00:00:00');
        }
        return $searchDate;
    }
}
