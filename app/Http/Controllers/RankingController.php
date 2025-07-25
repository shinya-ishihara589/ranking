<?php

namespace App\Http\Controllers;

use App\Common;
use App\Models\Item;
use App\Services\RankingService;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    /**
     * ランキング画面に遷移する
     * @param Object ランキング取得情報
     * @param Integer 項目ID
     * @return Object ランキング情報
     */
    public function index(Request $request, ?int $itemId = null): object
    {
        //ランキング情報を取得する
        $rankingModel = new RankingService;
        $rankingData = $rankingModel->getRankingData($request, $itemId);

        //項目情報を取得する
        $itemData = $rankingModel->getItemData($request, $itemId);

        //申請種類を取得する
        $applyTypes = Common::getApplyTypes();

        return view('ranking.index', compact(['rankingData', 'itemId', 'itemData', 'applyTypes']));
    }

    /**
     * ランキング情報を取得する
     * @param Object ランキング取得情報
     * @param Integer 項目ID
     * @return Object ランキング情報
     */
    public function get(Request $request, ?int $itemId = null): array
    {
        //ランキング情報を取得する
        $rankingModel = new RankingService;
        $rankingData = $rankingModel->getRankingData($request, $itemId);

        //項目情報を取得する
        $itemData = $rankingModel->getItemData($request, $itemId);

        //申請種類を取得する
        $applyTypes = Common::getApplyTypes();

        return compact(['rankingData', 'itemId', 'itemData', 'applyTypes']);
    }

    /**
     * ランキングに投票する
     * @param Object ランキング取得情報
     * @param String 画面の種類
     * @param Integer 投票ID
     * @param Integer 項目ID
     * @return Array ランキング情報
     */
    public function vote(Request $request, int $voteId): array
    {
        //ユーザーIDの取得する
        $userId = Auth::id();

        //投票情報を登録する
        $vote = new Vote;
        $vote->user_id = $userId;
        $vote->item_id = $voteId;
        $vote->ip = $request->ip();
        $vote->save();

        //ランキング情報を取得する
        $rankingModel = new RankingService();
        $rankingData = $rankingModel->getRankingData($request, $request->itemId);

        //項目情報を取得する
        $itemData = $rankingModel->getItemData($request, $request->itemId);

        return compact(['rankingData', 'itemData']);
    }
}
