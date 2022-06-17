<?php

namespace App\UseCases\SaleTransaction;

use App\Contracts\UseCase;
use App\Models\SaleTransactionDetail;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetAllSaleTransactionDetailsUseCase implements UseCase
{
    function execute(mixed $payload = null): LengthAwarePaginator
    {
        return SaleTransactionDetail::query()->paginate();
    }
}
