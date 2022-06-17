<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseTransactionDetail extends Model
{
    use HasFactory, UseUuid, SoftDeletes;

    public function purchaseTransactionHeader(): BelongsTo
    {
        return $this->belongsTo(PurchaseTransactionHeader::class);
    }
}
