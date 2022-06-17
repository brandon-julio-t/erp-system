<?php

namespace App\UseCases\PurchaseTransaction;

use App\Contracts\UseCase;
use App\Models\PurchaseTransactionDetail;
use App\Models\PurchaseTransactionHeader;
use Illuminate\Support\Facades\DB;

class CreatePurchaseTransactionUseCase implements UseCase
{
    function execute(mixed $payload = null): mixed
    {
        $data = collect($payload);
        return DB::transaction(function () use ($data) {
            $purchaseTransactionHeader = PurchaseTransactionHeader::factory()->create(
                $data->only(['user_id'])->all()
            );

            foreach ($data['details'] as $detail) {
                PurchaseTransactionDetail::factory()
                    ->for($purchaseTransactionHeader)
                    ->create(
                        collect($detail)->only(['product_id', 'quantity'])->all()
                    );
            }

            return $purchaseTransactionHeader;
        });
    }
}
