<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\PurchaseTransactionDetail;
use App\Models\PurchaseTransactionHeader;
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
        Product::factory()->count(20)->create();
        PurchaseTransactionHeader::factory()
            ->count(100)
            ->has(PurchaseTransactionDetail::factory()->count(5))
            ->create();
    }
}
