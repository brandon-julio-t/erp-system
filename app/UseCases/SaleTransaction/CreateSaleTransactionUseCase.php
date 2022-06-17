<?php

namespace App\UseCases\SaleTransaction;

use App\Contracts\UseCase;
use App\Models\SaleTransactionDetail;
use App\Models\SaleTransactionHeader;
use Illuminate\Support\Facades\DB;

class CreateSaleTransactionUseCase implements UseCase
{
    function execute(mixed $payload = null): mixed
    {
        $data = collect($payload);
        return DB::transaction(function () use ($data) {
            $saleTransactionHeader = SaleTransactionHeader::factory()->create(
                $data->only(['seller_user_id', 'buyer_user_id'])->all()
            );

            foreach ($data['details'] as $detail) {
                SaleTransactionDetail::factory()
                    ->for($saleTransactionHeader)
                    ->create(
                        collect($detail)->only(['product_id', 'quantity'])->all()
                    );
            }

            return $saleTransactionHeader;
        });
    }
}
