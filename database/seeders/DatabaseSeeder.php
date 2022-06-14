<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPurchaseTransaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->count(3)->create();
        Product::factory()->count(50)->create();
        ProductPurchaseTransaction::factory()->count(200)->create();
    }
}
