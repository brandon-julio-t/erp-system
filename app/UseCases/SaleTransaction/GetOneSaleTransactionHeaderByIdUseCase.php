<?php

namespace App\UseCases\SaleTransaction;

use App\Contracts\UseCase;
use App\Models\SaleTransactionHeader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GetOneSaleTransactionHeaderByIdUseCase implements UseCase
{
    function execute(mixed $payload = null): array|null|Builder|Collection|Model
    {
        return SaleTransactionHeader::query()->findOrFail($payload);
    }
}
