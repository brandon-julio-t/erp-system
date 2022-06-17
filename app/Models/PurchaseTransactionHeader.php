<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseTransactionHeader extends Model
{
    use HasFactory, UseUuid, SoftDeletes;

    public function purchaseTransactionDetails(): HasMany
    {
        return $this->hasMany(PurchaseTransactionDetail::class);
    }
}
