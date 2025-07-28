<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTmpRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $onetimePassword;

    /**
     * インスタンス
     * @param String ワンタイムパスワード
     */
    public function __construct($onetimePassword)
    {
        $this->onetimePassword = $onetimePassword;
    }

    /**
     * メールを送信する
     * @return Object メール内容
     */
    public function build(): object
    {
        return  $this->subject('ワンタイムパスワードの発行')->view('emails.tmp-register');
    }
}
