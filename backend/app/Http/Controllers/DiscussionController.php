<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    /**
     * 議論画面に遷移する
     * @param Request 検索条件
     * @return Array ランキング情報, パンくずリスト
     */
    public function index(Request $request)
    {
        //議論画面を取得する
        $discussionQuery = new Discussion;
        $discussionData = $discussionQuery->with([
            'item',
            'comments' => function ($query) {
                $query->orderByDesc('datetime');
            }
        ])->orderByDesc('datetime')->limit(10)->get();

        return view('discussions.index', compact(['discussionData']));
    }

    /**
     * 議論詳細画面に遷移する
     * @param Request 検索条件
     * @return Array ランキング情報, パンくずリスト
     */
    public function detail($discussionId)
    {
        //議論詳細画面を取得する
        $discussionQuery = new Discussion;
        $discussionData = $discussionQuery->with([
            'item',
            'comments' => function ($query) {
                $query->orderByDesc('datetime')->limit(10);
            }
        ])->find($discussionId);
        return view('discussions.detail', compact(['discussionData']));
    }
}
