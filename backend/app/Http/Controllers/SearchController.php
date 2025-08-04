<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    /**
     * 検索画面に遷移する
     * @param Object 検索取得情報
     * @return Object 検索情報
     */
    public function index(Request $request): object
    {
        //検索情報を取得する
        $searchModel = new SearchService;
        $searchData = $searchModel->getSearchData($request);

        return view('search.index', compact(['searchData']));
    }

    /**
     * ホームの追加情報を取得する
     * @param Object ホーム取得情報
     * @param String 画面の種類
     * @return Array ホームの追加情報
     */
    public function get(Request $request): array
    {
        //検索の追加情報を取得する
        $searchModel = new SearchService;
        $searchData = $searchModel->getSearchData($request);

        return compact(['searchData', 'request']);
    }
}
