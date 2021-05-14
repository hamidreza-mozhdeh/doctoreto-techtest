<?php

namespace Database\Factories;

use App\Models\DiscountCode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DiscountCodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DiscountCode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'code' => Str::random(4),
            'number_used' => $this->faker->randomNumber()
        ];
    }

    /**
     * Create new discount code.
     *
     * @return DiscountCodeFactory
     */
    public function unUsed(): DiscountCodeFactory
    {
        return $this->state(
            function (array $attributes) {
                return [
                    'number_used' => 0
                ];
            }
        );
    }
}
