<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WalletTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     *
     * Make a deposit test.
     *
     * @return void
     */
    public function deposit()
    {
        $user = User::factory()->create();
        $rand = rand(1000, 9000);
        /*
         * User id should not be pass as argument, Here is just a tech test.
         * */
        $this->postJson(
            route('wallets.deposit'),
            [
                'deposit' => $rand,
                'user_id' => $user->id,
            ]
        )->assertCreated();
        $this->assertEquals($user->balance(), $rand);
    }
}
