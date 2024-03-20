<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * 項目情報追加画面に遷移する
     * @param BigInteger 項目ID
     * @return Array ランキング情報, パンくずリスト
     */
    public function add($itemId = null)
    {
        //項目を追加する
        $item = Item::find($itemId);

        //パンくずリストを取得する
        $breadcrumbs = Item::getBreadcrumbs($itemId);

        return view('items.add', compact(['item', 'breadcrumbs', 'itemId']));
    }

    /**
     * 項目情報を追加する
     * @param Request 項目情報
     */
    public function store(Request $request, $itemId = null)
    {
        //ユーザーIDの取得する
        $userId = Auth::id();

        //項目を追加する
        $item = new Item;
        $item->item_id = $itemId;
        $item->user_id = $userId;
        $item->name = $request->model_item;
        $item->ip = $request->ip();
        $item->save();
    }
}
