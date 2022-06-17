<?php

namespace App\UseCases\SaleTransaction;

use App\Contracts\UseCase;
use App\Models\SaleTransactionHeader;

class DeleteSaleTransactionUseCase implements UseCase
{
    function execute(mixed $payload = null): SaleTransactionHeader
    {
        /** @var SaleTransactionHeader $entity */
        $entity = SaleTransactionHeader::query()->findOrFail($payload);
        $entity->delete();
        $entity->saleTransactionDetails()->delete();
        return $entity;
    }
}
