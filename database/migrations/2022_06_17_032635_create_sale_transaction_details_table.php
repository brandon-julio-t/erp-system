<?php

use App\Models\Product;
use App\Models\SaleTransactionHeader;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('sale_transaction_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(SaleTransactionHeader::class);
            $table->foreignIdFor(Product::class);
            $table->unsignedInteger('quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_transaction_details');
    }
};
