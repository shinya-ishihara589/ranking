<?php

namespace App\Services;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankingService extends BaseService
{
    /**
     * 項目IDからランキング情報を取得する
     * @return Object ランキング情報
     */
    public function getRankingData(Request $request, ?int $itemId = null): object
    {
        // 検索ワードを取得する
        $searchWords = $this->getSearchWordsArray($request->words);

        // 検索期間を取得する
        $searchDate = $this->getSearchDate($request->mode);

        // 取得するランキング情報の上限数を設定する
        $limit = $this->getSearchLimit($request->limit);

        // 取得するランキング情報の開始数を設定する
        $offset = ($request->offset) ? $request->offset : 0;

        // 項目に紐づく投票数を取得する
        $rankingQuery = Item::withCount(['votes' => function ($query) use ($searchDate) {
            $query
                ->select(DB::raw("COUNT(*)"))
                ->when($searchDate, function ($query) use ($searchDate) {
                    $query->where('datetime', '>=', $searchDate);
                });
        }]);

        // 検索を実施する
        $rankingQuery->when($searchWords, function ($query) use ($searchWords) {
            $query->whereIn('name', $searchWords);
        });

        $rankingQuery->where('item_id', $itemId)
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })->when($offset, function ($query) use ($offset) {
                $query->offset($offset);
            })->orderBy('votes_count', 'DESC');

        // ランキング情報を取得する
        $rankingData = $rankingQuery->get();

        return $rankingData;
    }

    /**
     * 項目IDから項目に紐づく投票数の合計を取得する
     * @return Integer 投票数の合計(votes_count)
     */
    public function getItemData(Request $request, ?int $itemId = null)
    {
        // 検索期間を取得する
        $searchDate = $this->getSearchDate($request->mode);

        // 項目に紐づく投票数を取得する
        $itemQuery = Item::withCount(['votes' => function ($query) use ($searchDate) {
            $query
                ->select(DB::raw("COUNT(*)"))
                ->when($searchDate, function ($query) use ($searchDate) {
                    $query->where('datetime', '>=', $searchDate);
                });
        }]);

        // 項目情報を取得する
        $itemData = $itemQuery->where('id', $itemId)->first();

        return $itemData;
    }

    /**
     * 検索期間を取得する
     * @param String 画面の種類
     * @return String 検索期間
     */
    private function getSearchDate(?string $mode = null): string
    {
        // 検索期間を初期化する
        $searchDate = '';

        // 現在の日時を取得する
        $now = Carbon::now();

        // 1.画面の種類が「yearly」の場合は「当年/1/1 00:00:00」を取得する
        // 2.画面の種類が「monthly」の場合は「当年/当月/1 00:00:00」を取得する
        // 3.画面の種類が「weekly」の場合は「当年/当月/当週の日曜日 00:00:00」を取得する
        // 4.画面の種類が「daily」の場合は「当年/当月/当日 00:00:00」を取得する
        if ($mode == 'yearly') {
            $searchDate = $now->format('Y/1/1 00:00:00');
        } else if ($mode == 'monthly') {
            $searchDate = $now->format('Y/m/1 00:00:00');
        } else if ($mode == 'weekly') {
            $searchDate = $now->subDay($now->dayOfWeek)->format("Y/m/d 00:00:00");
        } else if ($mode == 'daily') {
            $searchDate = $now->format('Y/m/d 00:00:00');
        }
        return $searchDate;
    }
}
