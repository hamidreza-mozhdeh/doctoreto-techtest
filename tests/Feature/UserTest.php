<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

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
        $response = $this->postJson(
            route('users.store'),
            [
                'mobile' => $user->mobile,
            ]
        )->assertCreated();

        $this->assertEquals($response->getOriginalContent()->mobile, $user->mobile);
    }

    /**
     * @test
     *
     * Get All Users test.
     *
     * @return void
     */
    public function getAllUsers()
    {
        User::truncate();
        $rand = rand(3, 9);
        User::factory()->count($rand)->create();
        $response = $this->getJson(route('users.index'))->assertOk();
        $this->assertEquals($rand, $response->getOriginalContent()->count());
    }

    /**
     * @test
     *
     * Get User test.
     *
     * @return void
     */
    public function getUser()
    {
        $user = User::factory()->create();
        $response = $this->getJson(route('users.show', $user))->assertOk();
        $this->assertTrue($response->getOriginalContent()->is($user));
    }
}
