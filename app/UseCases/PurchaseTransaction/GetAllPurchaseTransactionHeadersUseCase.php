<?php

namespace App\UseCases\PurchaseTransaction;

use App\Contracts\UseCase;
use App\Models\PurchaseTransactionHeader;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetAllPurchaseTransactionHeadersUseCase implements UseCase
{
    function execute(mixed $payload = null): LengthAwarePaginator
    {
        return PurchaseTransactionHeader::query()->paginate();
    }
}
