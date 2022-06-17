<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\PurchaseTransactionHeader;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class PurchaseTransactionDetailFactory extends Factory
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
            'purchase_transaction_header_id' => PurchaseTransactionHeader::factory(),
            'product_id' => Product::query()->inRandomOrder()->first()->getKey(),
            'quantity' => $this->faker->randomNumber() + 1, // min 1
        ];
    }
}
