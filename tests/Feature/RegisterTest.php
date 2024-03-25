<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Information;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * アカウント仮登録のテストを行う
     */
    public function test_tmp_register()
    {
        //バリデーションのテストを行う
        //1.ユーザーID:tmp_register_user_id:required|max:255|
        //2.メールアドレス:tmp_register_email:required|max:255|email|

        //メールアドレスとパスワードが未入力
        $response = $this->post('/tmp_register', ['tmp_register_user_id' => '', 'tmp_register_email' => 'email@gmail.com']);
        foreach ($response->baseResponse as $key => $respons) {
            dd($respons, $key, $response->baseResponse);
        }
        $this->assertFalse($response['result']);
        $this->assertEquals('ユーザーIDは、必ず指定してください。', $response['message']);
        $this->assertTrue(empty($response['user']));

        $this->assertTrue(true);
    }
}
