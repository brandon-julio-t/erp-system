<?php

namespace App\UseCases\PurchaseTransaction;

use App\Contracts\UseCase;
use App\Models\PurchaseTransactionDetail;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetAllPurchaseTransactionDetailsUseCase implements UseCase
{
    function execute(mixed $payload = null): LengthAwarePaginator
    {
        return PurchaseTransactionDetail::query()->paginate();
    }
}
