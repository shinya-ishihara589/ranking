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
        //1.ユーザーID:tmp_register_user_id:必須|0文字-255文字|
        //2.メールアドレス:tmp_register_email:required|max:255|email|

        //メールアドレスとパスワードが未入力
        // $response = $this->post('/tmp_register', ['tmp_register_user_id' => '', 'tmp_register_email' => '']);
        // // $response->assertStatus(302);
        // $response->setAccessible(false);
        // $response->assertSee('ユーザーIDは、必ず指定してください。');
        // dd($response);
    }
}
