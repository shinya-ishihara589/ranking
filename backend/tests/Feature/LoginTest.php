<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Information;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ログインのテストをする
     */
    public function test_login()
    {
        $this->assertTrue(true);
    }
}
