<?php

namespace Database\Factories;

use App\Models\SaleTransactionHeader;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class SaleTransactionHeaderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid()->toString(),
            'seller_user_id' => User::query()->inRandomOrder()->first()->getKey(),
            'buyer_user_id' => User::query()->inRandomOrder()->first()->getKey(),
        ];
    }
}
