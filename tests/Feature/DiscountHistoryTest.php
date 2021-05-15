<?php

namespace Tests\Feature;

use App\Models\DiscountCode;
use App\Models\DiscountHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class DiscountHistoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * Use a Discount code test.
     *
     * @return void
     */
    public function useDiscountCode()
    {
        $user = User::factory()->create();
        $discountCode = DiscountCode::factory()->unUsed()->create();

        $this->postJson(
            route('discount_histories.use_discount'),
            [
                'discount_code_id' => $discountCode->id,
                'user_id' => $user->id,
            ]
        )->assertCreated();

        $this->assertEquals(DiscountHistory::discountDeposit, $user->balance());
        $this->assertEquals(1, $discountCode->refresh()->number_used);
    }

    /**
     * @test
     *
     * User can not use code over limit test.
     *
     * @return void
     */
    public function userCanNotUseDiscountCodeOverLimit()
    {
        $users = User::factory()->count(DiscountHistory::usageLimit)->create();
        $discountCode = DiscountCode::factory()->unUsed()->create();

        foreach ($users as $user) {

            DiscountHistory::applyDiscountCode($discountCode, $user);
        }
        $this->assertEquals(DiscountHistory::usageLimit, $discountCode->refresh()->number_used);

        $user = User::factory()->create();
        $this->postJson(
            route('discount_histories.use_discount'),
            [
                'discount_code_id' => $discountCode->id,
                'user_id' => $user->id,
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @test
     *
     * User can not use code double time test.
     *
     * @return void
     */
    public function userCanNotUseDiscountCodeDoubleTime()
    {
        $user = User::factory()->create();
        $discountCode = DiscountCode::factory()->unUsed()->create();
        DiscountHistory::applyDiscountCode($discountCode, $user);

        $this->postJson(
            route('discount_histories.use_discount'),
            [
                'discount_code_id' => $discountCode->id,
                'user_id' => $user->id,
            ]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }


}
