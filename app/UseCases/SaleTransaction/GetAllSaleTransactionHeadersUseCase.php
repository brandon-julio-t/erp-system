<?php

namespace App\UseCases\SaleTransaction;

use App\Contracts\UseCase;
use App\Models\SaleTransactionHeader;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetAllSaleTransactionHeadersUseCase implements UseCase
{
    function execute(mixed $payload = null): LengthAwarePaginator
    {
        return SaleTransactionHeader::query()->paginate();
    }
}
