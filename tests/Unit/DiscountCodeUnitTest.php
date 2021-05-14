<?php

namespace Tests\Unit;

use App\Models\DiscountCode;
use Tests\TestCase;

class DiscountCodeUnitTest extends TestCase
{
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

        $createdDiscountCode = DiscountCode::createObject(
            $discountCode->code,
            $discountCode->number_used
        );

        $this->assertTrue($createdDiscountCode instanceof DiscountCode);
        $this->assertEquals($createdDiscountCode->code, $discountCode->code);
        $this->assertEquals($createdDiscountCode->number_used, $discountCode->number_used);
    }
}
