<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    use HasFactory;

    public $timestamps = false; //自動タイムスタンプをオフにする

    private $offset;        //取得開始数
    private $userId;        //ユーザーID

    /**
     * コンストラクタ
     * @param Object 検索情報
     */
    function __construct(int $offset = 0)
    {
        $this->offset = $offset;
        $this->userId = Auth::id();
    }

    /**
     * 通知に紐づくユーザー情報を取得する
     */
    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    /**
     * 通知情報を取得する
     * @return Object 通知情報
     */
    public function getNotificationData(): object
    {
        $notificationQuery = Notification::with([
            'sender',
            'sender.profile'
        ])->where('receiver_id', $this->userId)
            ->limit(10)
            ->offset($this->offset)
            ->orderByDesc('datetime');
        return $notificationQuery->get();
    }

    /**
     * 通知情報を登録する
     * @param Integer 受信者ID
     * @param String 行動
     * @return Object 通知情報
     */
    public function addNotificationData(string $receiverId, int $action): void
    {
        $this->receiver_id = $receiverId;
        $this->sender_id = $this->userId;
        $this->text = $action;
        $this->save();
    }
}
