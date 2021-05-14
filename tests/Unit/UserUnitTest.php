<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserUnitTest extends TestCase
{
    /**
     * @test
     *
     * Create User test.
     *
     * @return void
     */
    public function createUser()
    {
        $user = User::factory()->make();

        $createdUser = User::createObject(
            $user->mobile,
            $user->name
        );

        $this->assertTrue($createdUser instanceof User);
        $this->assertEquals($createdUser->mobile, $user->mobile);
        $this->assertEquals($createdUser->name, $user->name);
    }
}
