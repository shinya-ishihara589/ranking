<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * ホーム画面に遷移する
     * @param Object ホーム取得情報
     * @return Object ホーム情報
     */
    public function index(Request $request): object
    {
        //ホーム情報を取得する
        $homeModel = new Home($request);
        $homeData = $homeModel->getHomeData();

        return view('home.index', compact(['homeData', 'request']));
    }

    /**
     * ホーム情報を取得する
     * @param Object ホーム取得情報
     * @return Object ホーム情報
     */
    public function get(Request $request): array
    {
        //ホーム情報を取得する
        $homeModel = new Home($request);
        $homeData = $homeModel->getHomeData();

        return compact(['homeData', 'request']);
    }
}
