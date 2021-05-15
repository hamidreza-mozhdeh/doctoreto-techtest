<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wallet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'deposit' => $this->faker->randomNumber(),
            'withdraw' => $this->faker->randomNumber(),
            'balance' => $this->faker->randomNumber(),
        ];
    }

    /**
     * Create zero wallet.
     *
     * @return WalletFactory
     */
    public function zero(): WalletFactory
    {
        return $this->state(
            function (array $attributes) {
                return [
                    'deposit' => 0,
                    'withdraw' => 0,
                    'balance' => 0,
                ];
            }
        );
    }
}
