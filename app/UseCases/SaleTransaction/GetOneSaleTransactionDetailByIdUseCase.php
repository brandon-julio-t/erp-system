<?php

namespace App\UseCases\SaleTransaction;

use App\Contracts\UseCase;
use App\Models\SaleTransactionDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GetOneSaleTransactionDetailByIdUseCase implements UseCase
{
    function execute(mixed $payload = null): array|null|Builder|Collection|Model
    {
        return SaleTransactionDetail::query()->findOrFail($payload);
    }
}
