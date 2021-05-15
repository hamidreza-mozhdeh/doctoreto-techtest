<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Wallet;
use Tests\TestCase;

class WalletUnitTest extends TestCase
{
    /**
     * @test
     *
     * Create Wallet test.
     *
     * @return void
     */
    public function createWallet()
    {
        $wallet = Wallet::factory()->make();

        $createdWallet = Wallet::createObject(
            $wallet->user_id,
            $wallet->deposit,
            $wallet->withdraw,
            $wallet->balance,
        );

        $this->assertTrue($createdWallet instanceof Wallet);
        $this->assertEquals($createdWallet->user_id, $wallet->user_id);
        $this->assertEquals($createdWallet->deposit, $wallet->deposit);
        $this->assertEquals($createdWallet->withdraw, $wallet->withdraw);
        $this->assertEquals($createdWallet->balance, $wallet->balance);
    }

    /**
     * @test
     *
     * Make Deposit test.
     *
     * @return void
     */
    public function makeDeposit()
    {
        $user = User::factory()->create();

        $rand = rand(1000, 9000);
        $user->deposit($rand);
        $this->assertEquals($user->balance(), $rand);

        $user->deposit(2000);
        $this->assertEquals($user->balance(), $rand + 2000);
    }
}
