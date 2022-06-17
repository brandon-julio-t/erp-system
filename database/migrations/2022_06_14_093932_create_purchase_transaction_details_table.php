<?php

use App\Models\Product;
use App\Models\PurchaseTransactionHeader;
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
        Schema::create('purchase_transaction_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(PurchaseTransactionHeader::class);
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
    public function down()
    {
        Schema::dropIfExists('purchase_transaction_details');
    }
};
