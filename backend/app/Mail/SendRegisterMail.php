<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userId;
    public $password;

    /**
     * インスタンス
     * @param String ワンタイムパスワード
     */
    public function __construct($userId, $password)
    {
        $this->userId = $userId;
        $this->password = $password;
    }

    /**
     * メールを送信する
     * @return Object メール内容
     */
    public function build(): object
    {
        return  $this->subject('アカウント登録が完了しました')->view('emails.register');
    }
}
