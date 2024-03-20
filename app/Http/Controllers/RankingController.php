<?php

namespace App\Http\Controllers;

use App\Common;
use App\Models\Item;
use App\Models\Ranking;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankingController extends Controller
{
    /**
     * ランキング情報を取得しランキング画面に遷移する
     * @param Object ランキング取得情報
     * @param String 画面の種類
     * @param Integer 項目ID
     * @return Object ランキング情報
     */
    public function index(Request $request, string $mode, int $itemId = null): object
    {
        //ランキング情報を取得する
        $rankingModel = new Ranking($request->words, $mode, $itemId);
        $rankingData = $rankingModel->getRankingData();

        //パンくずリストを取得する
        $breadcrumbs = $rankingModel->getBreadcrumbs();

        //項目情報を取得する
        $itemData = $rankingModel->getItemData($itemId);

        //申請種類を取得する
        $applyTypes = Common::getApplyTypes();

        return view('ranking.index', compact(['rankingData', 'request', 'breadcrumbs', 'itemId', 'itemData', 'applyTypes', 'mode']));
    }

    /**
     * ランキングの追加情報を取得する
     * @param Object ランキング取得情報
     * @param String 画面の種類
     * @param Integer 項目ID
     * @return Array ランキング情報
     */
    public function acquisition(Request $request, string $mode, int $itemId = null): array
    {
        //ランキング情報を取得する
        $rankingModel = new Ranking($request->words, $mode, $itemId, $request->limit);
        $rankingData = $rankingModel->getRankingData();

        //項目情報を取得する
        $itemData = $rankingModel->getItemData($itemId);

        return compact(['rankingData', 'itemData']);
    }

    /**
     * ランキングに投票する
     * @param Object ランキング取得情報
     * @param String 画面の種類
     * @param Integer 投票ID
     * @param Integer 項目ID
     * @return Array ランキング情報
     */
    public function vote(Request $request, string $mode, int $voteId, int $itemId = null): array
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
        $rankingModel = new Ranking($request->words, $mode, $itemId, $request->limit);
        $rankingData = $rankingModel->getRankingData();

        //項目情報を取得する
        $itemData = $rankingModel->getItemData($itemId);

        return compact(['rankingData', 'itemData']);
    }

    /**
     * ランキングに投票する
     * @param Object ランキング取得情報
     * @param String 画面の種類
     * @param Integer 投票ID
     * @param Integer 項目ID
     * @return Array ランキング情報
     */
    public function store(Request $request, string $mode, int $itemId = null): array
    {
        //ユーザーIDの取得する
        $userId = Auth::id();

        //項目を追加する
        $item = new Item;
        $item->item_id = $itemId;
        $item->user_id = $userId;
        $item->name = $request->modalItem;
        $item->ip = $request->ip();
        $item->save();

        //ランキング情報を取得する
        $rankingModel = new Ranking($request->words, $mode, $itemId, $request->limit + 1);
        $rankingData = $rankingModel->getRankingData();

        //項目情報を取得する
        $itemData = $rankingModel->getItemData($itemId);

        return compact(['rankingData', 'itemData']);
    }
}
