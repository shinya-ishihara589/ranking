<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * isAdminのテストを行う
     */
    public function testIsAdmin(): void
    {
        $user = new User;
        $user->role = '1';
        $this->assertTrue($user->isAdmin());
    }

    /**
     * isUserのテストを行う
     */
    public function testIsUser(): void
    {
        $user = new User;
        $user->role = '99';
        $this->assertTrue($user->isUser());
    }
}
