<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Ranking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * 項目を追加する
     * @param Object ランキング取得情報
     * @param Integer 項目ID
     * @return Array ランキング情報
     */
    public function store(Request $request, int $itemId = null): array
    {
        //ユーザーIDの取得する
        $userId = Auth::id();

        //項目を追加する
        $item = new Item;
        $item->item_id = $itemId;
        $item->user_id = $userId;
        $item->name = $request->name;
        $item->ip = $request->ip();
        $item->save();

        //ランキング情報を取得する
        $rankingModel = new Ranking($request, $itemId);
        $rankingData = $rankingModel->getRankingData();

        //項目情報を取得する
        $itemData = $rankingModel->getItemData($itemId);

        return compact(['rankingData', 'itemData']);
    }
}
