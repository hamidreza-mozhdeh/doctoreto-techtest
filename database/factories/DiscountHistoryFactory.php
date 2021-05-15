<?php

namespace Database\Factories;

use App\Models\DiscountHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DiscountHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $discountCode = DiscountCodeFactory::factory()->create();
        $user = User::factory()->create();

        return [
            'discount_code_id' => $discountCode->id,
            'user_id' => $user->id,
        ];
    }
}
