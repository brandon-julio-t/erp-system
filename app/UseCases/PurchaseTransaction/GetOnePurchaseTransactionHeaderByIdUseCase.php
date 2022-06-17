<?php

namespace App\UseCases\PurchaseTransaction;

use App\Contracts\UseCase;
use App\Models\PurchaseTransactionHeader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GetOnePurchaseTransactionHeaderByIdUseCase implements UseCase
{
    function execute(mixed $payload = null): array|null|Builder|Collection|Model
    {
        return PurchaseTransactionHeader::query()->findOrFail($payload);
    }
}
