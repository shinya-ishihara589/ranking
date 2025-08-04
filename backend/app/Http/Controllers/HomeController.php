<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * ホーム画面に遷移する
     * @param Object ホーム取得情報
     * @return Object ホーム情報
     */
    public function index(Request $request)
    {
        //ホーム情報を取得する
        $homeModel = new HomeService();
        $homeData = $homeModel->getHomeData($request);

        return view('home.index', compact(['homeData', 'request']));
    }

    /**
     * ホーム情報を取得する
     * @param Object ホーム取得情報
     * @return Object ホーム情報
     */
    public function get(Request $request)
    {
        //ホーム情報を取得する
        $homeModel = new HomeService();
        $homeData = $homeModel->getHomeData($request);

        return compact(['homeData', 'request']);
    }
}
