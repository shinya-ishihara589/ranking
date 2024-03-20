<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * 検索画面に遷移する
     * @param Object 検索取得情報
     * @return Object 検索情報
     */
    public function index(Request $request): object
    {
        //検索情報を取得する
        $searchModel = new Search($request->words);
        $searchData = $searchModel->getSearchData();

        return view('search.index', compact(['searchData', 'request']));
    }

    /**
     * ホームの追加情報を取得する
     * @param Object ホーム取得情報
     * @param String 画面の種類
     * @return Array ホームの追加情報
     */
    public function acquisition(Request $request): array
    {
        //検索の追加情報を取得する
        $searchModel = new Search($request->words, $request->offset);
        $searchData = $searchModel->getSearchData();

        return compact(['searchData', 'request']);
    }
}
