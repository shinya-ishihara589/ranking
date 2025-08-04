<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends BaseController
{
    /**
     * 通知画面に遷移する
     * @param Request 検索条件
     * @return Array 通知情報
     */
    public function index(): object
    {
        //通知画面を取得する
        $notificationModel = new Notification();
        $notificationData = $notificationModel->getNotificationData();

        return view('notification.index', compact(['notificationData']));
    }

    /**
     * 通知画面に遷移する
     * @param Request 検索条件
     * @return Array 通知情報
     */
    public function get(Request $request): array
    {
        //通知画面を取得する
        $notificationModel = new Notification($request->offset);
        $notificationData = $notificationModel->getNotificationData();

        return compact(['notificationData']);
    }
}
