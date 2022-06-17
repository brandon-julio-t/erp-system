<?php

namespace App\UseCases\PurchaseTransaction;

use App\Contracts\UseCase;
use App\Models\PurchaseTransactionHeader;

class DeletePurchaseTransactionUseCase implements UseCase
{
    function execute(mixed $payload = null): PurchaseTransactionHeader
    {
        /** @var PurchaseTransactionHeader $entity */
        $entity = PurchaseTransactionHeader::query()->findOrFail($payload);
        $entity->delete();
        $entity->purchaseTransactionDetails()->delete();
        return $entity;
    }
}
