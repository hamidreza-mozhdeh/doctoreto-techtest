<?php

namespace Tests\Unit;

use App\Models\DiscountCode;
use App\Models\DiscountHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiscountHistoryUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * Use Discount Code test.
     *
     * @return void
     */
    public function useDiscountCode()
    {
        $user = User::factory()->create();
        $discountCode = DiscountCode::factory()->unUsed()->create();

        DiscountHistory::applyDiscountCode($discountCode, $user);

        $this->assertEquals($discountCode->refresh()->number_used, 1);
        $this->assertEquals($user->refresh()->balance(), DiscountHistory::discountDeposit);
    }
}
