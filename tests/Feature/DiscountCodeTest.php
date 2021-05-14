<?php

namespace Tests\Feature;

use App\Models\DiscountCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DiscountCodeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     *
     * Create Discount Code test.
     *
     * @return void
     */
    public function createDiscountCode()
    {
        $discountCode = DiscountCode::factory()->make();
        $response = $this->postJson(
            route('discount_codes.store'),
            [
                'code' => $discountCode->code,
            ]
        )->assertCreated();

        $this->assertEquals($response->getOriginalContent()->code, $discountCode->code);
        $this->assertEquals($response->getOriginalContent()->number_used, 0);
    }

    /**
     * @test
     *
     * Get All Discount Codes test.
     *
     * @return void
     */
    public function getAllDiscountCodes()
    {
        $rand = rand(3, 9);
        DiscountCode::factory()->count($rand)->create();
        $response = $this->getJson(route('discount_codes.index'))->assertOk();
        $this->assertEquals($rand, count($response->getOriginalContent()));
    }

    /**
     * @test
     *
     * Get Discount Code test.
     *
     * @return void
     */
    public function getDiscountCode()
    {
        $discountCode = DiscountCode::factory()->create();
        $response = $this->getJson(route('discount_codes.show', $discountCode))
            ->assertOk();
        $this->assertTrue($response->getOriginalContent()->is($discountCode));
    }
}
