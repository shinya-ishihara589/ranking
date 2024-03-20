<?php

namespace App\Http\Controllers;

use App\Common;
use App\Models\Item;
use App\Models\Notification;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * 議論画面に遷移する
     * @param Request 検索条件
     * @return Array ランキング情報, パンくずリスト
     */
    public function index(): object
    {
        //議論画面を取得する
        $notificationData = Notification::where('receiver_id', Auth::id())->get();

        return view('notification.index', compact(['notificationData']));
    }

    /**
     * 議論画面に遷移する
     * @param Request 検索条件
     * @return Array ランキング情報, パンくずリスト
     */
    public function store($id)
    {
        //テキストを取得する
        $text = '';

        //通知を保存する
        $notification = new Notification;
        $notification->receiver_id = $id;
        $notification->sender_id = Auth::id();
        $notification->text = $text;
        $item->ip = $request->ip();
        $notification->save();

        return view('discussions.detail', compact(['discussionData']));
    }
}
