<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * ホーム画面に遷移する
     * @param Object ホーム取得情報
     * @param String 画面の種類
     * @return Object ホーム情報
     */
    public function index(Request $request, string $mode = 'all'): object
    {
        //ホーム情報を取得する
        $homeModel = new Home($request->words, $mode);
        $homeData = $homeModel->getHomeData();

        return view('home.index', compact(['homeData', 'request', 'mode']));
    }

    /**
     * ホームの追加情報を取得する
     * @param Object ホーム取得情報
     * @param String 画面の種類
     * @return Array ホームの追加情報
     */
    public function acquisition(Request $request, string $mode = 'all'): array
    {
        //ホームの追加情報を取得する
        $homeModel = new Home($request->words, $mode, $request->offset);
        $homeData = $homeModel->getHomeData();

        return compact(['homeData', 'request']);
    }
}
